const stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');

initialize();

async function initialize() {

    const fetchClientSecret = async () => {
        const response = await fetch("../../app/Services/user/StripeService.php", {
            method: "POST",
        });
        const { clientSecret } = await response.json();
        return clientSecret; 
    }
    
    const checkout = await stripe.initEmbeddedCheckout({
        fetchClientSecret,
    });

    checkout.mount('#checkout');
}