import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout";
import InputLabel from "../../Components/InputLabel";
import TextInput from "../../Components/TextInput";
import InputError from "../../Components/InputError";
import PrimaryButton from "../../Components/PrimaryButton";
import { useState } from "react";
import { forgotPassword } from "../../Services/auth/auth";

export default function ForgotPassword () {
    
    const [email, setEmail] = useState('');
    const [errors, setErrors] = useState({});

    const handleChange = (e) => {
        setEmail(e.target.value);
    }

    const handleSumbit = async (e) => {
        e.preventDefault();
        setErrors({});

        const { data, errors } = await forgotPassword(email);

        if (errors) {
            setErrors(errors);
        } 
    }

    return (
        <AuthenticatedLayout>
           <div className="w-full h-full md:w-fit md:h-fit md:flex md:flex-col z-20 bg-red-50 rounded-xl">
                <div className="form-wrapper p-16">
                    <div className="flex flex-col gap-y-5 mb-10">
                        <div className="logo mx-auto">
                            <img className="w-auto h-full object-cover" src="storage/images/icons/patisserie.svg" alt=""></img>
                        </div>
                        <p className="font-mer text-h1 text-center">Forgot password</p>
                    </div>
                    
                    <p className="font-mer text-body text-center mb-10">Please enter your email address, the reset form will be sent there</p>
                    <form onSubmit={handleSumbit} method="POST" className="flex flex-col gap-y-5">
                        <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')}/>
                        <div className="flex flex-col gap-y-2">
                            <InputLabel value="email" htmlFor="email" className="font-mer"></InputLabel>
                            <TextInput id="email"  type="email" name="email" value={email} onChange={(e) => handleChange(e)}></TextInput>
                        </div>
                        <PrimaryButton className="w-full justify-center" type="submit" >
                            <p className="font-mer text-body text-center">Send reset password form</p>
                        </PrimaryButton>
                    </form>
                </div>

                
           </div>
        </AuthenticatedLayout>
    )
}
