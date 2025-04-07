initialize();

async function initialize() 
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const sessionId = urlParams.get('session_id');
    const response = await fetch('/user/embeddedPayment/embeddedCheckoutForm', {
        method: "POST",
        body: JSON.stringify({ sessionId: sessionId}),
        headers: {
            Accept: 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf"]').getAttribute('content'),
            'Content-type': 'application/json',
        },
    });
    const session = await response.json();

    if (session.status == 'open') {
        window.location.replace('http://localhost');
    }
    else if (session.status == 'complete') {
        document.getElementById('success').classList.remove('hidden');
        document.getElementById('customer-email').textContent = session.customer_email;
    }

}