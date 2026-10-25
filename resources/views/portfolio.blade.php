<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Irfan Dossani — Design Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/figma-portfolio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jarvis.css') }}">
</head>
<body>
    <header class="site-header">
        <a class="site-signature" href="#top" aria-label="Irfan Dossani home">ID<span>IRFAN DOSSANI</span></a>
        <nav aria-label="Primary navigation">
            <a href="#work">Work</a>
            <a href="#about">About</a>
            <a href="#jarvis">Jarvis</a>
            <a class="nav-contact" href="#contact">Contact me</a>
        </nav>
    </header>

    <main id="top">
        <section class="cover" aria-labelledby="portfolio-title">
            <div class="cover-orbit orbit-one"></div><div class="cover-orbit orbit-two"></div><div class="cover-orbit orbit-three"></div>
            <p class="cover-kicker">STRATEGY · DESIGN · TECHNOLOGY</p>
            <h1 id="portfolio-title"><span>IRFAN DOSSANI</span>DESIGN PORTFOLIO</h1>
            <p class="cover-intro">Brand thinking, digital experiences and practical AI for businesses ready to grow.</p>
            <a class="scroll-cue" href="#about">Explore selected work <span>↓</span></a>
        </section>

        <section class="case-overview" id="about">
            <div class="section-intro">
                <p class="eyebrow">01 / OVERVIEW</p>
                <h2>Design that makes a business <em>move.</em></h2>
                <p class="lead">I create the strategy, identity and digital system that help ambitious businesses look sharper, work smarter and earn attention.</p>
                <div class="overview-columns">
                    <div><h3>The challenge</h3><p>Growth needs more than a beautiful page. It needs a clear offer, a credible presence and a digital journey that gives people a reason to take the next step.</p></div>
                    <div><h3>My role</h3><p>I work from first idea through live launch: brand strategy, visual direction, web design, development, marketing systems and AI-enabled workflows.</p></div>
                </div>
                <div class="process"><h3>My process</h3><div class="chips"><span>Discovery</span><span>Brand strategy</span><span>UX direction</span><span>Design systems</span><span>Web development</span><span>AI automation</span><span>Launch support</span></div></div>
            </div>
            <div class="portrait-stage" aria-label="Irfan Dossani, designer and digital builder"><div class="portrait-copy"><b>12+</b><span>YEARS MAKING<br>IDEAS REAL</span></div><div class="portrait-sun"></div><div class="portrait-lines"></div><p>Muscat<br><i>Oman</i></p></div>
        </section>

        <section class="projects" id="work" aria-labelledby="projects-title">
            <p class="eyebrow">02 / SELECTED PROJECTS</p>
            <h2 id="projects-title">Work with a reason<br>to exist.</h2>
            <article class="project-row project-safety">
                <div class="device desktop safety-screen"><div class="browser"><i></i><i></i><i></i><span>SAFETYMARTONLINE.COM</span></div><div class="screen-content"><small>SAFETY MART</small><b>Protection,<br>simplified.</b><p>A clearer digital route to serious safety products.</p><button>Explore products</button></div><div class="safety-mark">+</div></div>
                <div class="project-copy"><p class="project-number">01 / B2B COMMERCE</p><h3>Safety Mart Online</h3><h4>Confidence in every click.</h4><p>A conversion-focused B2B storefront that makes specialised products easier to discover, understand and enquire about.</p><a href="https://safetymartonline.com" target="_blank" rel="noopener">Visit project ↗</a><div class="chips"><span>Strategy</span><span>UX design</span><span>Web build</span></div></div>
            </article>
            <article class="project-row project-travel">
                <div class="device desktop travel-screen"><div class="browser"><i></i><i></i><i></i><span>ARABIANDREAMSTOURS.COM</span></div><div class="screen-content"><small>ARABIAN DREAMS</small><b>Discover<br>the real Oman.</b><p>Private tours, real places and a more personal way to travel.</p><button>Plan your journey</button></div><div class="dune dune-one"></div><div class="dune dune-two"></div><div class="sun"></div></div>
                <div class="project-copy"><p class="project-number">02 / TRAVEL EXPERIENCE</p><h3>Arabian Dreams Tours</h3><h4>A journey begins before the flight.</h4><p>A premium travel platform shaped around inspiration, trust and a smoother path from curiosity to booking.</p><a href="https://arabiandreamstours.com" target="_blank" rel="noopener">Visit project ↗</a><div class="chips"><span>Brand direction</span><span>Product design</span><span>AI assistant</span></div></div>
            </article>
            <article class="project-row project-wallet">
                <div class="device phone"><div class="phone-speaker"></div><div class="wallet-screen"><small>eWallet</small><span>Available balance</span><strong>$3,200.00</strong><div class="wallet-card"><small>VISA</small><b>•••• 4829</b><span>IRFAN DOSSANI</span></div><div class="wallet-actions"><i>↑</i><i>↓</i><i>+</i></div></div></div>
                <div class="project-copy"><p class="project-number">03 / PRODUCT CONCEPT</p><h3>eWallet App</h3><h4>Finance made human.</h4><p>A product concept built around trust, clarity and the small interactions that make modern technology feel effortless.</p><div class="chips"><span>Product UX</span><span>Mobile UI</span><span>Design system</span></div></div>
            </article>
        </section>

        <section class="jarvis-section" id="jarvis">
            <div class="jarvis-copy"><p class="eyebrow">03 / ON-DEMAND THINKING</p><h2>Meet <em>J.A.R.V.I.S.</em></h2><p>Pronounced <strong>Jarvis.</strong> Your first conversation can start before the first project meeting. Ask about marketing, websites, AI or the smart next move for your business.</p><div class="jarvis-note"><span>●</span> Powered by a real project-hand-off flow</div></div>
            <div class="assistant-panel">
                <div class="assistant-head"><span class="assistant-dot"></span><b>J.A.R.V.I.S.</b><small>ONLINE</small></div>
                <div class="assistant-chat" aria-live="polite"><p class="assistant-message">Ask Jarvis about marketing, web products, AI, automation, or your next business move.</p></div>
                <form class="assistant-form"><label class="sr-only" for="jarvis-question">Ask Jarvis a question</label><input id="jarvis-question" maxlength="800" name="question" placeholder="What are you trying to build?" required><button type="submit">Ask ↗</button></form>
                <details class="lead-handoff"><summary>Want Irfan to review this? Send your project brief ↗</summary><form class="lead-form"><label>Name<input name="name" autocomplete="name" maxlength="120" required></label><label>Email<input name="email" type="email" autocomplete="email" maxlength="254" required></label><label>Phone / WhatsApp<input name="phone" type="tel" autocomplete="tel" maxlength="50" required></label><label class="lead-consent"><input name="consent" type="checkbox" required> I agree that my details and this Jarvis conversation can be emailed to Irfan for a project follow-up.</label><input class="honeypot" name="website" tabindex="-1" autocomplete="off" aria-hidden="true"><button type="submit">Send my brief ↗</button><p class="lead-status" aria-live="polite"></p></form></details>
            </div>
        </section>

        <section class="contact-slide" id="contact">
            <div><p class="eyebrow">04 / CONTACT</p><h2>Let’s build something<br><em>worth remembering.</em></h2><p>For brand, web and AI projects — from the first sketch to a working system.</p><a class="contact-email" href="mailto:idossani@cloudandvps.com">idossani@cloudandvps.com</a><div class="contact-links"><a href="https://wa.me/96875054024" target="_blank" rel="noopener">WhatsApp ↗</a><span>Muscat, Oman · Available worldwide</span></div></div>
            <div class="contact-disc"><span>IRFAN<br>DOSSANI</span><b>✦</b></div>
        </section>
    </main>
    <footer><span>© {{ now()->year }} Irfan Shiraj Dossani</span><a href="#top">Back to top ↑</a></footer>
    <script src="{{ asset('js/portfolio.js') }}" defer></script>
</body>
</html>
