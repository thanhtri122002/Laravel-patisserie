import InputLabel from "../../Components/InputLabel";
import TextInput from "../../Components/TextInput";
import InputError from "../../Components/InputError";
import PrimaryButton from "../../Components/PrimaryButton";
import { register } from "../../Services/auth/auth";
import { useState } from "react";

export default function RegisterForm() {
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    const [errors, setErrors] = useState({});

    const handleChange = (event) => {
        const { name, value } = event.target;
        setFormData((prev) => ({ ...prev, [name]: value }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});
        console.log('asdfasdfas');
        const { data, error } = await register(formData);
        if (error) {
            setErrors(error);
            console.log(error);
        } else {
            console.log('login successs');
            window.location.href = '/home';
        }
    };

    return (
        <div className="form-wrapper">
            <div className="logo mx-auto">
                <img
                    className="w-auto h-full object-cover"
                    src="storage/images/icons/patisserie.svg"
                    alt=""
                ></img>
            </div>
            <p className="font-mer text-h1 text-center">Registration</p>

            <form
                onSubmit={handleSubmit}
                method="POST"
                className="flex flex-col gap-y-5"
            >
                <input
                    type="hidden"
                    name="_token"
                    value={document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content")}
                />
                <div className="flex flex-col gap-y-2">
                    <InputLabel
                        value="name"
                        htmlFor="register_name"
                    ></InputLabel>
                    <TextInput
                        id="register_name"
                        type="text"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                    ></TextInput>
                    <InputError
                        className="text-red"
                        message={errors.name}
                    ></InputError>
                </div>
                <div className="flex flex-col gap-y-2">
                    <InputLabel
                        value="email"
                        htmlFor="register_email"
                    ></InputLabel>
                    <TextInput
                        id="register_email"
                        type="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                    ></TextInput>
                    <InputError
                        className="text-red"
                        message={errors.email}
                    ></InputError>
                </div>
                <div className="flex flex-col gap-y-2">
                    <InputLabel
                        value="password"
                        htmlFor="register_password"
                    ></InputLabel>
                    <TextInput
                        id="register_password"
                        name="password"
                        value={formData.password}
                        onChange={handleChange}
                    ></TextInput>
                    <InputError
                        className="text-red"
                        message={errors.password}
                    ></InputError>
                </div>
                <div className="flex flex-col gap-y-2">
                    <InputLabel
                        value="confirm password"
                        htmlFor="register_password_confirmation"
                    ></InputLabel>
                    <TextInput
                        id="register_password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={formData.password_confirmation || ""}
                        onChange={handleChange}
                    />
                    <InputError className="text-red-50"></InputError>
                </div>
                <PrimaryButton className="w-full justify-center">
                    <p className="font-mer text-body">Register Now</p>
                </PrimaryButton>
            </form>
        </div>
    );
}
