<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class JarvisControllerTest extends TestCase
{
    public function test_jarvis_sends_a_valid_message_to_claude_without_exposing_the_key(): void
    {
        config()->set('services.anthropic.key', 'test-key');
        config()->set('services.anthropic.model', 'test-model');

        Http::fake([
            'api.anthropic.com/*' => Http::response([
                'content' => [['type' => 'text', 'text' => 'Jarvis is ready.']],
            ]),
        ]);

        $this->postJson(route('jarvis.respond'), ['message' => 'What can Irfan build?'])
            ->assertOk()
            ->assertJsonPath('message', 'Jarvis is ready.')
            ->assertJsonPath('configured', true);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.anthropic.com/v1/messages'
                && $request->hasHeader('x-api-key', 'test-key')
                && $request['model'] === 'test-model';
        });
    }

    public function test_jarvis_does_not_attempt_an_api_call_without_a_key(): void
    {
        config()->set('services.anthropic.key', null);
        Http::fake();

        $this->postJson(route('jarvis.respond'), ['message' => 'Hello Jarvis'])
            ->assertStatus(503)
            ->assertJsonPath('configured', false);

        Http::assertNothingSent();
    }
}
