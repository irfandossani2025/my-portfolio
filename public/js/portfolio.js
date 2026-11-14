const response = document.querySelector('.assistant-message');
let lastIrfanTwoQuestion = '';

const askIrfanTwo = async (message, fallback) => {
    lastIrfanTwoQuestion = message;
    response.classList.add('typing');
    response.textContent = 'Irfan 2.0 is thinking…';

    try {
        const result = await fetch('/jarvis/respond', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({ message }),
        });
        const data = await result.json();
        response.textContent = data.message || fallback;
    } catch (error) {
        response.textContent = fallback;
    } finally {
        response.classList.remove('typing');
    }
};

document.querySelector('.assistant-form')?.addEventListener('submit', (event) => {
    event.preventDefault();
    const input = event.currentTarget.elements.question;
    const message = input.value.trim();

    if (!message) return;

    askIrfanTwo(message, 'Irfan 2.0 could not prepare a response just now. Please contact Irfan by email or WhatsApp to continue.');
    input.value = '';
});
document.querySelector('.lead-form')?.addEventListener('submit', async (event) => {
    event.preventDefault();
    const form = event.currentTarget;
    const status = form.querySelector('.lead-status');

    if (!lastIrfanTwoQuestion || response.classList.contains('typing')) {
        status.textContent = 'Ask Irfan 2.0 a question first, then send the resulting brief.';
        return;
    }

    const submit = form.querySelector('button[type="submit"]');
    const payload = Object.fromEntries(new FormData(form));
    payload.question = lastIrfanTwoQuestion;
    payload.summary = response.textContent.trim();
    payload.consent = form.elements.consent.checked;
    submit.disabled = true;
    status.textContent = 'Sending your brief…';

    try {
        const result = await fetch('/jarvis/handoff', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify(payload),
        });
        const data = await result.json();
        status.textContent = data.message || 'Your brief could not be sent just now.';
        if (result.ok) form.reset();
    } catch (error) {
        status.textContent = 'Your brief could not be sent just now. Please try again or contact Irfan directly.';
    } finally {
        submit.disabled = false;
    }
});

const arabianDreamsLink = document.querySelector('a[href="https://arabiandreamstours.com"]');
if (arabianDreamsLink) arabianDreamsLink.href = 'https://arabiandreamtours.com';

const orbit = document.querySelector('[data-project-orbit]');
if (orbit) {
    const cards = [...orbit.querySelectorAll('[data-project-card]')];
    const count = orbit.querySelector('[data-orbit-count]');
    let active = 0;
    const placements = [
        ['translate(-50%,-50%) translate3d(0,0,90px) rotateY(0)', '1', '3'],
        ['translate(-50%,-50%) translate3d(28%,3%,0) rotateY(-26deg) scale(.84)', '.7', '2'],
        ['translate(-50%,-50%) translate3d(-28%,3%,0) rotateY(26deg) scale(.84)', '.7', '1'],
    ];
    const renderOrbit = () => {
        cards.forEach((card, index) => {
            const position = (index - active + cards.length) % cards.length;
            const [transform, opacity, zIndex] = placements[position];
            card.style.transform = transform;
            card.style.opacity = opacity;
            card.style.zIndex = zIndex;
            card.classList.toggle('is-active', index === active);
            card.tabIndex = index === active ? 0 : -1;
        });
        count.textContent = `${String(active + 1).padStart(2, '0')} / ${String(cards.length).padStart(2, '0')}`;
    };
    const move = (direction) => { active = (active + direction + cards.length) % cards.length; renderOrbit(); };
    orbit.querySelector('[data-orbit-prev]').addEventListener('click', () => move(-1));
    orbit.querySelector('[data-orbit-next]').addEventListener('click', () => move(1));
    cards.forEach((card, index) => card.addEventListener('click', (event) => { if (index !== active) { event.preventDefault(); active = index; renderOrbit(); } }));
    orbit.addEventListener('keydown', (event) => { if (event.key === 'ArrowLeft') move(-1); if (event.key === 'ArrowRight') move(1); });
    renderOrbit();
}
