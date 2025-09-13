import React, { useState } from "react";
import { PaymentElement, useCheckout } from "@stripe/react-stripe-js";
import {BillingAddressElement} from '@stripe/react-stripe-js/checkout';
import { useHandleBlur, handleChange, validateInput } from "../../utils/checkoutHandlers";
import { EmailInput } from "./Components/EmailInput";

const CheckoutForm = () => {

    const [payload, setPayLoad] = useState({
        email: "",
        phoneNumber: "",
    });
    const [errors, setErrors] = useState({});
    const [message, setMessage] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const onBlur = useHandleBlur(setErrors);
    const onChange = handleChange(setPayLoad);

    const checkoutState = useCheckout();

    if (checkoutState.type === 'loading') {
        return (
        <div>Loading...</div>
        )
    } else if (checkoutState.type === 'error') {
        return (
            <div>Error: {checkoutState.error.message}</div>
        )
    }
    const {checkout} = checkoutState;

    const handleSubmit = async (e) => {
        e.preventDefault();

        setIsLoading(true);
        const { isValid: isValidMail, message: messageMail } = await validateInput('email', payload.email, checkout);
        const { isValid: isValidPhone, message: messagePhone } = await validateInput('phoneNumber', payload.phoneNumber, checkout);

        // const { isValid, message } = await validateEmail(email, checkout);
        // if (!isValid) {
        //     setEmailError(message);
        //     setMessage(message);
        //     setIsLoading(false);
        //     return;
        // }
        if (!isValidMail || !isValidPhone || !isValidBillingAddress ){
            setErrors({
                email: isValidMail ? null : messageMail,
                phoneNumber: isValidPhone ? null : messagePhone,
                billingAddress: isValidBillingAddress ? null : messageBillingAddress
            })
            setIsLoading(false);
            return;
        }
        const confirmResult = await checkout.confirm();

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (confirmResult.type === "error") {
            setMessage(confirmResult.error.message);
        }

        setIsLoading(false);
    };

    return (
        <form onSubmit={handleSubmit}>
            <EmailInput
                value={payload.email}
                error={errors.email}
                onChange={onChange}
                onBlur={onBlur}
            ></EmailInput>
            <BillingAddressElement />
            <h4>Payment</h4>
            <PaymentElement id="payment-element" />
            <button disabled={isLoading} id="submit">
                {isLoading ? (
                    <div className="spinner"></div>
                ) : (
                    `Pay ${checkout.total.total.amount} now`
                )}
            </button>
            {/* Show any error or success messages */}
            {message && <div id="payment-message">{message}</div>}
        </form>
    );
};

export default CheckoutForm;
