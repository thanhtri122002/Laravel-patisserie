import { useState } from "react";

export default function useForm (initValues) {
    const [values, setValues] = useState(initValues);
    const [errors, setErrors] = useState({});
    
    const handleChange = (e) => {
        const {name, value} = e.target;
        setValues((prev) => ({...prev, [name]: value}));

    }

    return { values, setValues, errors, setErrors, handleChange };
}