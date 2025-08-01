// AuthTabsForm.jsx
import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { login, register } from "../../Services/auth/auth";
import TextInput from "../../Components/TextInput";
import InputLabel from "../../Components/InputLabel";
import InputError from "../../Components/InputError";
import PrimaryButton from "../../Components/PrimaryButton";

const fadeVariant = {
  hidden: { opacity: 0, x: 50 },
  visible: { opacity: 1, x: 0 },
  exit: { opacity: 0, x: -50 },
};

export default function AuthTabsForm({ className = "" }) {

    const [activeTab, setActiveTab] = useState("login");
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        password: "",
    });
    const [errors, setErrors] = useState({});

    const handleChange = (e) => {
        setFormData((prev) => ({
        ...prev,
        [e.target.name]: e.target.value,
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});
        const payload =
        activeTab === "login"
            ? { email: formData.email, password: formData.password }
            : formData;

        const response = activeTab === "login" ? await login(payload) : await register(payload);

        if (response.error) setErrors(response.error);
        else window.location.href = '/';
    };

    return (
        <div className={`flex flex-col justify-center max-w-md mx-auto ${className}`}>
            <div className="logo mx-auto">
                <img className="w-auto h-full object-cover" src="storage/images/icons/patisserie.svg" alt=""></img>
            </div>

            {/* Tabs */}
            <div className="flex justify-center mb-6">
                {["login", "register"].map((tab) => (
                <button
                    key={tab}
                    onClick={() => setActiveTab(tab)}
                    className={`px-4 py-2 text-body font-mer transition duration-500 border-b-2 ${
                    activeTab === tab
                        ? "border-[--Brown-Dark] text-[--Brown-Dark]"
                        : "border-transparent text-gray-400 hover:text-[--Brown-Light]"
                    }`}
                >
                    {tab === "login" ? "Login" : "Register"}
                </button>
                ))}
            </div>

            {/* Form Panel */}
            <AnimatePresence mode="wait">
                <motion.form
                key={activeTab}
                onSubmit={handleSubmit}
                method="POST"
                className="space-y-4"
                variants={fadeVariant}
                initial="hidden"
                animate="visible"
                exit="exit"
                >
                <input
                    type="hidden"
                    name="_token"
                    value={document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
                />

                {activeTab === "register" && (
                    <div className="flex flex-col gap-y-1">
                    <InputLabel htmlFor="name" value="Name" />
                    <TextInput
                        id="name"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                    />
                    <InputError message={errors.name?.[0]} />
                    </div>
                )}

                <div className="flex flex-col gap-y-1">
                    <InputLabel htmlFor="email" value="Email" />
                    <TextInput
                    id="email"
                    name="email"
                    type="email"
                    value={formData.email}
                    onChange={handleChange}
                    />
                    <InputError message={errors.email?.[0]} />
                </div>

                <div className="flex flex-col gap-y-1">
                    <InputLabel htmlFor="password" value="Password" />
                    <TextInput
                    id="password"
                    name="password"
                    type="password"
                    value={formData.password}
                    onChange={handleChange}
                    />
                    <InputError message={errors.password?.[0]} />
                </div>

                <div>
                    <PrimaryButton type="submit" className="w-full justify-center">
                    <p className="font-mer text-body">
                        {activeTab === "login" ? "Login" : "Register"}
                    </p>
                    </PrimaryButton>
                </div>
                </motion.form>
            </AnimatePresence>
        </div>
    );
}
