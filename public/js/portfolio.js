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
