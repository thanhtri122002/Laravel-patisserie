import InputLabel from "../../Components/InputLabel";
import TextInput from "../../Components/TextInput";
import InputError from "../../Components/InputError";
import PrimaryButton from "../../Components/PrimaryButton";
import { useState, useMemo } from "react";
import { login } from "../../Services/auth/auth";
import GuestsNotification from "../../Components/GuestsNotifications";

/**
 *
 * Login Form component
 *
 * A Login form component that manages user credentials ('email', 'password')
 *
 * Features:
 * Uses React state to manage the form data and validation errors
 * Submits the data to the login service and redirects to home when success
 * Display the input labels, erros message and a styled primary button
 * Include the csrf toekn form meta tag for secure POST request
 * Provides a forgot password link in case users forget their password
 *
 * @component
<<<<<<< HEAD
 * 
=======
 * ]
>>>>>>> master
 * @returns {JSX.Element} A styled login form
 *
 * @example
 * return <LoginForm>
 */
export default function LoginForm() {
    const [formData, setFormData] = useState({
        email: "",
        password: "",
    });
<<<<<<< HEAD
=======
    let status;
>>>>>>> master
    const [errors, setErrors] = useState({});

    const handleChange = (event) => {
        const { name, value } = event.target;
        setFormData((prevFormData) => ({ ...prevFormData, [name]: value }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});

        const { data, errors } = await login(formData);
<<<<<<< HEAD
        if (errors) {
            status = false;
=======
        console.log(data);
        if (errors) {
            console.log(errors);
            status = false;
            setErrors(errors);
>>>>>>> master
        } else {
            window.location.href = "/home";
        }
    };

    const memoizedErrors = useMemo(() => errors, [errors]);
<<<<<<< HEAD

=======
    console.log(formData);
>>>>>>> master
    return (
        <div className="form-wrapper">
            <GuestsNotification NotiData={memoizedErrors} status={false} />
            <div className="logo mx-auto">
                <img
                    className="w-auto h-full object-cover"
                    src="storage/images/icons/patisserie.svg"
                    alt=""
                ></img>
            </div>
            <p className="font-mer text-h1 text-center">Log in</p>

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
                ></input>
                <div className="flex flex-col gap-y-2">
                    <InputLabel
                        value="email"
                        htmlFor="login_email"
                        className="font-mer"
                    ></InputLabel>
                    <TextInput
                        id="login_email"
                        type="email"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                    ></TextInput>
                    <InputError
                        className="font-mer text-[--alert-error]"
                        message={errors.email}
                    ></InputError>
                </div>
                <div className="flex flex-col gap-y-2">
                    <div className="flex justify-between items-center">
                        <InputLabel
                            value="password"
                            htmlFor="login_password"
                            className="font-mer"
                        ></InputLabel>
                        <a href="/forgot-password" className="custom-link">
                            Forgot your password?
                        </a>
                    </div>

                    <TextInput
                        id="login_password"
                        name="password"
                        value={formData.password}
                        onChange={handleChange}
                    ></TextInput>
                    <InputError
                        className="font-mer text-[--alert-error]"
                        message={errors.password}
                    ></InputError>
                </div>
                <div className="flex flex-row justify-end  items-start">
                    <PrimaryButton
                        className="w-full justify-center"
                        type="submit"
                    >
                        <p className="font-mer text-body text-center">Log In</p>
                    </PrimaryButton>
                </div>
            </form>
        </div>
    );
}

/**
 * Note
 * Mistake 1: Debounce the handleChange
 *          +) Effect: the state does not immediately update on each keystroke, it will wait for the delay to push the last keystroke's character
 * 
 */