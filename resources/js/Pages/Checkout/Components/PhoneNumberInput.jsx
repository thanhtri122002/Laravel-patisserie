import React from "react";
import TextInput from "../../../Components/TextInput";
import InputLabel from "../../../Components/InputLabel";
import InputError from "../../../Components/InputError";

const PhoneNumberInput = ({ value, error, onBlur, onChange }) => {

    return (
          
        <div className="flex flex-col gap-3">
            <InputLabel html_for="phoneNumber" value="Phone Number" className="text-[--text-default]"/>
                <TextInput
                    type="text"
                    name="phoneNumber"
                    value={value}
                    error={error}
                    onChange={onChange}
                    onBlur={onBlur}
                    className="rounded-[1rem]"
                />
            <InputError message={error} />
            
        </div>
    );
};

export default PhoneNumberInput;