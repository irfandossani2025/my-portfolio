<?php

namespace Tests\Feature;

use App\Mail\JarvisLeadMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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
                && $request['model'] === 'test-model'
                && str_contains($request['system'], 'marketing, branding, websites, web applications, AI solutions')
                && str_contains($request['system'], '+968 7505 4024')
                && str_contains($request['system'], 'idossani@cloudandvps.com')
                && str_contains($request['system'], 'cannot send messages, store leads, or notify Irfan');
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

    public function test_a_visitor_can_consent_to_email_their_jarvis_brief_to_irfan(): void
    {
        config()->set('services.jarvis.lead_recipient', 'irfan@example.test');
        Mail::fake();

        $this->postJson(route('jarvis.handoff'), [
            'name' => 'Aisha Al Balushi',
            'email' => 'aisha@example.test',
            'phone' => '+968 9000 0000',
            'question' => 'How can we market our restaurant opening?',
            'summary' => 'Launch with teaser content and a reservation flow.',
            'consent' => true,
            'website' => '',
        ])->assertOk()
            ->assertJsonPath('message', 'Your project brief has been sent to Irfan. He will review the details and reply using the contact information you provided.');

        Mail::assertSent(JarvisLeadMail::class, function (JarvisLeadMail $mail) {
            $envelope = $mail->envelope();

            return $mail->hasTo('irfan@example.test')
                && $envelope->subject === 'New Jarvis lead: Aisha Al Balushi'
                && $envelope->replyTo[0]->address === 'aisha@example.test';
        });
    }

    public function test_a_jarvis_brief_requires_explicit_consent(): void
    {
        Mail::fake();

        $this->postJson(route('jarvis.handoff'), [
            'name' => 'Aisha Al Balushi',
            'email' => 'aisha@example.test',
            'phone' => '+968 9000 0000',
            'question' => 'How can we market our restaurant opening?',
            'summary' => 'Launch with teaser content and a reservation flow.',
            'consent' => false,
        ])->assertUnprocessable()
            ->assertJsonValidationErrors('consent');

        Mail::assertNothingSent();
    }
}
