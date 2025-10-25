import React, { useState, useEffect } from "react";
import { PaymentElement, useCheckout } from "@stripe/react-stripe-js/checkout";
import {
    useHandleBlur,
    handleChange,
    validateInput,
} from "../../utils/checkoutHandlers";
import { BillingAddressElement } from "@stripe/react-stripe-js/checkout";
import PrimaryButton from "../../Components/PrimaryButton";
import PhoneNumberInput from "./Components/PhoneNumberInput";
import LoadingSpinner from "../../Components/LoadingSpinner";
const CheckoutForm = () => {

    useEffect(() => {
        console.log("CheckoutForm mounted");
    }, []);
    
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
    console.log("FULL checkoutState:", checkoutState);
    if (checkoutState.type === "loading") {
        return (
            <div className="h-[30dvh] flex items-center justify-center">
                <LoadingSpinner />
            </div>
        );
    } else if (checkoutState.type === "error") {
        return (
            <div>
                Error: {checkoutState.error.message}
                <pre>{JSON.stringify(checkoutState, null, 2)}</pre>
            </div>
        );
    }
    const { checkout } = checkoutState;

    const handleSubmit = async (e) => {
        e.preventDefault();

        setIsLoading(true);
        // const { isValid: isValidMail, message: messageMail } =
        //     await validateInput("email", payload.email, checkout);
        const { isValid: isValidPhone, message: messagePhone } =
            await validateInput("phoneNumber", payload.phoneNumber, checkout);

        // const { isValid, message } = await validateEmail(email, checkout);
        // if (!isValid) {
        //     setEmailError(message);
        //     setMessage(message);
        //     setIsLoading(false);
        //     return;
        // }
        if (!isValidPhone) {
            setErrors({
                // email: isValidMail ? null : messageMail,
                phoneNumber: isValidPhone ? null : messagePhone,
            });
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
        <form onSubmit={handleSubmit} className="flex flex-col gap-5 my-5 md:container md:mx-auto">
            
            <p className="text-h1 font-mer self-center">Payment</p>
            <PhoneNumberInput
                value={payload.phoneNumber}
                error={errors.phoneNumber}
                onChange={onChange}
                onBlur={onBlur}
            />
            <BillingAddressElement />
            <p className="font-mer text-h3 text-[--Rich-Brown]">Payment</p>
            <PaymentElement id="payment-element" />
            <PrimaryButton disabled={isLoading} id="submit" className="w-fit">
                {isLoading ? (
                    <div className="spinner"></div>
                ) : (
                    <p className="text-body">
                        Pay {checkout.total.total.amount} now
                    </p>
                    
                )}
            </PrimaryButton>
            {/* Show any error or success messages */}
            {message && <div id="payment-message">{message}</div>}
        </form>
    );
};

export default CheckoutForm;
