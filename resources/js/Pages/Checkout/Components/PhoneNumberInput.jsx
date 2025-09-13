import React from "react";
import { useCheckout } from "@stripe/react-stripe-js";

export default PhoneNumberInput = ({ value, error, onBlur, onChange }) => {

    return (
        <>
            <label>
                Phone Number
                <input
                    type="text"
                    name="phoneNumber"
                    error={error}
                    value={value}
                    onChange={onChange}
                    onBlur={onBlur}
                />
            </label>
            {error && <div id="phoneNumber-errors">{error}</div>}
        </>
    );
};
