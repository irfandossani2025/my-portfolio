<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Jarvis lead</title>
</head>
<body style="margin:0;background:#f4f5f7;color:#151921;font-family:Arial,sans-serif;line-height:1.55;">
    <main style="max-width:680px;margin:24px auto;background:#fff;border:1px solid #e1e3e8;">
        <header style="padding:24px 28px;background:#111722;color:#eef1f6;">
            <p style="margin:0 0 6px;color:#c9ff42;font-size:12px;font-weight:bold;letter-spacing:.08em;">JARVIS · CLIENT HANDOFF</p>
            <h1 style="margin:0;font-size:24px;">New project conversation</h1>
        </header>
        <section style="padding:28px;">
            <p style="margin-top:0;color:#5a6472;font-size:13px;">Received {{ $receivedAt->format('D, j M Y · g:i A T') }}</p>
            <h2 style="font-size:18px;">Client details</h2>
            <p><strong>Name:</strong> {{ $lead['name'] }}<br>
            <strong>Email:</strong> <a href="mailto:{{ $lead['email'] }}">{{ $lead['email'] }}</a><br>
            <strong>Phone:</strong> <a href="tel:{{ $lead['phone'] }}">{{ $lead['phone'] }}</a></p>
            <h2 style="font-size:18px;">What they asked Jarvis</h2>
            <p style="white-space:pre-wrap;">{{ $lead['question'] }}</p>
            <h2 style="font-size:18px;">Jarvis conversation summary</h2>
            <p style="white-space:pre-wrap;">{{ $lead['summary'] }}</p>
            <p style="margin:24px 0 0;color:#5a6472;font-size:12px;">The client explicitly requested that this brief be shared with Irfan.</p>
        </section>
    </main>
</body>
</html>
