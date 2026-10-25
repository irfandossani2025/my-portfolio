<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>Irfan Dossani — New Portfolio in Progress</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/portfolio-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jarvis.css') }}">
</head>
<body>
    <main>
        <section class="reset-intro">
            <p class="eyebrow">IRFAN DOSSANI / NEW PORTFOLIO</p>
            <h1>A new digital home<br>is taking shape.</h1>
            <p>The previous portfolio has been archived. A new experience is being designed from a clean foundation.</p>
            <a href="mailto:idossani@cloudandvps.com">idossani@cloudandvps.com ↗</a>
        </section>
        <section class="assistant-wrap" aria-labelledby="irfan-two-title">
            <div class="assistant-label"><span>01</span><p>KEEPING THE CONVERSATION OPEN</p></div>
            <div class="assistant-panel">
                <div class="assistant-head"><span class="assistant-dot"></span><b id="irfan-two-title">IRFAN 2.0</b><small>ONLINE</small></div>
                <div class="assistant-chat" aria-live="polite"><p class="assistant-message">The new portfolio is in progress. Tell me what you are trying to build and I’ll help you find the next step.</p></div>
                <form class="assistant-form"><label class="sr-only" for="jarvis-question">Ask Irfan 2.0 a question</label><input id="jarvis-question" maxlength="800" name="question" placeholder="What are you trying to improve?" required><button type="submit">Ask ↗</button></form>
                <details class="lead-handoff"><summary>Want Irfan to review this? Send your project brief ↗</summary><form class="lead-form"><label>Name<input name="name" autocomplete="name" maxlength="120" required></label><label>Email<input name="email" type="email" autocomplete="email" maxlength="254" required></label><label>Phone / WhatsApp<input name="phone" type="tel" autocomplete="tel" maxlength="50" required></label><label class="lead-consent"><input name="consent" type="checkbox" required> I agree that my details and this conversation can be emailed to Irfan for a project follow-up.</label><input class="honeypot" name="website" tabindex="-1" autocomplete="off" aria-hidden="true"><button type="submit">Send my brief ↗</button><p class="lead-status" aria-live="polite"></p></form></details>
            </div>
        </section>
    </main>
    <footer><span>© {{ now()->year }} Irfan Shiraj Dossani</span><a href="https://wa.me/96875054024" target="_blank" rel="noopener">WhatsApp ↗</a></footer>
    <script src="{{ asset('js/portfolio.js') }}" defer></script>
</body>
</html>
