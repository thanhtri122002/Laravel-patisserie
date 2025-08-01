import InputLabel from "../../Components/InputLabel";
import TextInput from "../../Components/TextInput";
import InputError from "../../Components/InputError";
import PrimaryButton from "../../Components/PrimaryButton";
import { useState } from "react";
import { useForm, Link } from "@inertiajs/react";
import { login } from "../../Services/auth/auth";

export default function LoginForm ( { children, ...props } ) {
    
    const [formData, setFormData] = useState({
        email: "",
        password: "",
    });

    const [errors, setErrors] = useState({});

    const handleChange = (event) => {
        const { name, value } = event.target;
        setFormData((prevFormData) => ( {...prevFormData, [name] : value} ));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});

        const { data, errors } = await login(formData)
        
        if (errors) {
            setErrors(errors);
        } else {
            
            window.location.href = '/';
        }
    }

    return (
        <div className="form-wrapper">
            <div className="logo mx-auto">
                <img className="w-auto h-full object-cover" src="storage/images/icons/patisserie.svg" alt=""></img>
            </div>
            <p className="font-mer text-h1 text-center">Log in</p>

            <form onSubmit={handleSubmit} method="POST" className="flex flex-col gap-y-5">
                <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')}></input>
                <div className="flex flex-col gap-y-2">
                    <InputLabel value="email" htmlFor="login_email" className="font-mer"></InputLabel>
                    <TextInput id="login_email" type="email" name="email" value={formData.email} onChange={handleChange}></TextInput>
                    <InputError className="font-mer text-[--alert-error]"></InputError>
                </div>
                <div className="flex flex-col gap-y-2">
                    <div className="flex justify-between items-center">
                        <InputLabel value="password" htmlFor="login_password" className="font-mer"></InputLabel>
                        <a href="/forgot-password" className="custom-link">Forgot your password?</a>
                    </div>
                    
                    <TextInput id="login_password" name="password" value={formData.password} onChange={handleChange}></TextInput>
                    <InputError className="font-mer text-[--alert-error]"></InputError>
                </div>
                <div className="flex flex-row justify-end  items-start">
                    <PrimaryButton className="w-full justify-center" type="submit" >
                        <p className="font-mer text-body text-center">Log In</p>
                    </PrimaryButton>
                    
                </div>
            </form>
        </div>
    )
    
}