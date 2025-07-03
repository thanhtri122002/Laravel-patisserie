const stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');

initialize();

async function initialize() {
    const invoiceId = window.invoiceId;
    const fetchClientSecret = async () => {
        const response = await fetch(`/user/embeddedPayment/embeddedCheckoutForm/${invoiceId}`, {
            method: "POST",
        });
        const { clientSecret } = await response.json();
        console.log(clientSecret);
        return clientSecret; 
    }
    
    const checkout = await stripe.initEmbeddedCheckout({
        fetchClientSecret,
    });

    checkout.mount('#checkout');
}