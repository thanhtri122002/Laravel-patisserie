import { Mail, ExternalLink, Instagram, Twitter, Youtube } from "lucide-react";
import TextInput from "../../Components/TextInput";
import InputLabel from "../../Components/InputLabel";
import { useState } from "react";
import { sendContact } from "../../Services/guest.service";
import GuestsNotification from "../../Components/GuestsNotifications";

export default function ContactPage() {
    const [payload, setPayload] = useState({
        firstName: "",
        lastName: "",
        eMail: "",
        message: "",
    });
    
    const [errors, setErrors] = useState({});
    
    const handleChange = (e) => {
        const { name, value } = e.target;
        setPayload((prev) => ({ ...prev, [name]: value }));
    };
    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});
        try {
            const response = await sendContact(payload);

        } catch (err) {
            setErrors(err);
            console.log(err);
        }

    }
    return (
        <>  
            <GuestsNotification notiData={response} status={true}/>
            <div className="huge-container mx-auto h-[70dvh] flex">
                <div className="my-auto px-20 py-10 w-full h-[2/3] flex flex-col justify-center md:flex-row">
                    {/* Left Side */}
                    <div className="w-1/2 flex flex-col gap-y-32">
                        <div className="flex flex-col gap-y-10">
                            <p className="font-mer text-h1">Get In Touch</p>
                            <p className="font-mer text-h3 text-[--text-default]">We'd like to hear from you</p>
                            <p className="font-mer text-body text-[--text-default]">
                                If you have any inquires or just want to say hi, please use the contact form!
                            </p>
                        </div>
                        <div className="flex flex-row gap-x-5">
                            <div className="flex flex-col gap-y-10">
                                <Mail className="w-8 h-8" />
                                <ExternalLink className="w-8 h-8" />
                            </div>
                            <div className="flex flex-col justify-between">
                                <a href="mailto:info@patisserie.com" className="font-mer text-body text-[--Pink-Primary] transition duration-300 hover:underline">
                                    info@patisserie.com
                                </a>
                                <div className="flex flex-row justify-evenly">
                                    <Instagram className="w-8 h-8" />
                                    <Twitter className="w-8 h-8" />
                                    <Youtube className="w-8 h-8" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Right Side Form */}
                    <div onSubmit={handleSubmit} className="w-1/2 flex justify-center items-center">
                        <form className="flex flex-col gap-y-5 p-5">
                            <div className="flex flex-row justify-center items-center gap-x-10">
                                <div className="flex flex-col gap-y-3">
                                    <InputLabel htmlFor="firstName" value="First Name" />
                                    <TextInput
                                        id="firstName"
                                        name="firstName"
                                        value={payload.firstName}
                                        onChange={handleChange}
                                    />
                                </div>
                                <div className="flex flex-col gap-y-3">
                                    <InputLabel htmlFor="lastName" value="Last Name" />
                                    <TextInput
                                        id="lastName"
                                        name="lastName"
                                        value={payload.lastName}
                                        onChange={handleChange}
                                    />
                                </div>
                            </div>

                            <div className="flex flex-col gap-y-3">
                                <InputLabel htmlFor="eMail" value="Email" />
                                <TextInput
                                    type="email"
                                    id="eMail"
                                    name="eMail"
                                    value={payload.eMail}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="flex flex-col gap-y-3">
                                <InputLabel htmlFor="message" value="Message" />
                                <textarea
                                    id="message"
                                    name="message"
                                    value={payload.message}
                                    onChange={handleChange}
                                    className="rounded-md border-gray-300 shadow-sm focus:border-[--Pink-Primary] focus:ring-[--Pink-Primary]"
                                />
                            </div>

                            <button
                                type="submit"
                                className="font-mer text-[--White-Primary] bg-[--Pink-Primary] px-6 py-2 rounded-full transition-all hover:scale-105 hover:shadow-[0_0_20px_var(--Pink-Primary)]"
                            >
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}
