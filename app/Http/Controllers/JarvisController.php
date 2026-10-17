<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JarvisController extends Controller
{
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
                    'system' => 'You are Jarvis, the concise portfolio assistant for Irfan Shiraj Dossani in Muscat. Answer only about Irfan’s work, services, experience, selected projects, and how to start a project. Never invent prices, clients, achievements, timelines, or capabilities. Keep answers friendly, useful, and under 110 words. If asked outside that scope, briefly invite the visitor to contact Irfan through WhatsApp or email.',
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
