import React, { useState } from "react";
import { PaymentElement, useCheckout } from "@stripe/react-stripe-js";
import {
    handleBlur,
    handleChange,
    validateInput,
} from "../../../utils/checkoutHandlers";

const EmailInput = ({ value, error, onChange, onBlur }) => {
    return (
        <>
            <label>
                Email
                <input
                    name="email"
                    type="text"
                    value={value}
                    onChange={onChange}
                    onBlur={onBlur}
                    className={error ? "error" : ""}
                />
            </label>
            {error && <div id="email-errors">{error}</div>}
        </>
    );
};

export default EmailInput;
