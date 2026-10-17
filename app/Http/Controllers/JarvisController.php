<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JarvisController extends Controller
{
    private const SYSTEM_PROMPT = <<<'PROMPT'
You are Jarvis, Irfan Shiraj Dossani's sharp, practical digital strategy assistant. You represent Irfan's independent digital studio in Muscat, Oman.

Your role is to help prospective clients with marketing, branding, websites, web applications, AI solutions, automation, customer journeys, lead generation, and full-stack technical strategy. Think like a senior marketing strategist and full-stack developer together: understand the business objective, identify the real bottleneck, recommend the most useful solution, and explain the sensible next step in plain language.

For every question:
1. Give a direct, useful answer first.
2. When helpful, suggest a practical solution that covers strategy, UX, technology, and implementation.
3. Ask one focused discovery question if important information is missing.
4. When the visitor is interested in working with Irfan, finish with a short "Next step" and a compact "Handoff brief" containing the visitor's stated goal, recommended direction, and what Irfan should discuss next.

You may answer general marketing and technical questions, but do not pretend to have audited the visitor's business, accessed their systems, or completed work. Never invent facts, pricing, timelines, clients, credentials, integrations, results, or capabilities. Never promise that Irfan will contact the visitor, that a lead was sent, or that a handoff was recorded: you cannot send messages, store leads, or notify Irfan.

Use only these verified contact details when inviting a visitor to continue: WhatsApp/phone +968 7505 4024 and email idossani@cloudandvps.com. Never provide any other contact number or email address.

Keep answers concise, confident, friendly, and ideally under 180 words. Use short headings or bullets only when they make a recommendation easier to scan.
PROMPT;

    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'min:2', 'max:800'],
        ]);

        $apiKey = config('services.anthropic.key');

        if (blank($apiKey)) {
            return response()->json([
                'message' => 'Jarvis is being prepared for live conversation. Please use WhatsApp or email to start a project today.',
                'configured' => false,
            ], 503);
        }

        try {
            $response = Http::acceptJson()
                ->withHeaders([
                    'x-api-key' => $apiKey,
                    'anthropic-version' => '2023-06-01',
                ])
                ->timeout(25)
                ->post('https://api.anthropic.com/v1/messages', [
                    'model' => config('services.anthropic.model'),
                    'max_tokens' => 350,
                    'system' => self::SYSTEM_PROMPT,
                    'messages' => [[
                        'role' => 'user',
                        'content' => $validated['message'],
                    ]],
                ]);

            if ($response->failed()) {
                Log::warning('Anthropic request failed for Jarvis.', ['status' => $response->status()]);

                return response()->json([
                    'message' => 'Jarvis is temporarily unavailable. Please try again in a moment or contact Irfan directly.',
                ], 502);
            }

            $text = data_get($response->json(), 'content.0.text');

            if (! is_string($text) || blank($text)) {
                Log::warning('Anthropic response did not include assistant text.');

                return response()->json([
                    'message' => 'Jarvis could not prepare a response just now. Please try again.',
                ], 502);
            }

            return response()->json(['message' => $text, 'configured' => true]);
        } catch (\Throwable $exception) {
            Log::warning('Jarvis request could not reach Anthropic.', ['exception' => $exception->getMessage()]);

            return response()->json([
                'message' => 'Jarvis is temporarily unavailable. Please try again shortly.',
            ], 502);
        }
    }
}
