import { useCheckout } from "@stripe/react-stripe-js/checkout";

const validateInput = async (field, value, checkout) => {
    let updateResult;

    switch (field) {
        case "email":
            updateResult = await checkout.updateEmail(value);
            break;
        case "phoneNumber":
            updateResult = await checkout.updatePhoneNumber(value);
            break;
        case "billingAddress":
            updateResult = await checkout.updateBillingAddress({
                line1: value, 
            });
            break;
        default:
            return { isValid: true, message: null };
    }

    const isValid = updateResult.type !== "error";

    return { isValid, message: !isValid ? updateResult.error.message : null };
};

const useHandleBlur = (setErrors) => {
    const checkout = useCheckout();

    return async (e) =>{
        const { name, value } = e.target;
        if (!value) return;

        const { isValid, message } = await validateInput(name, value, checkout);

        setErrors((prev) => ({
            ...prev,
            [name]: isValid ? null : message,
        }));
    } 
};

const handleChange = (setPayLoad) => (e) => {
    const {name, value} = e.target; 

    setPayLoad((prev) => ({
        ...prev,
        [name]: value,
    }));
};

export {
    useHandleBlur,
    handleChange,
    validateInput
}