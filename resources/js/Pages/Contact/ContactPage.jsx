import HeroBanner from "../../Components/HeroBanner"
import { Mail, ExternalLink, Instagram, Twitter, Youtube} from "lucide-react";
import TextInput from "../../Components/TextInput";
import InputLabel from "../../Components/InputLabel";
import { useState } from "react";

export default function ContactPage () {
    const [payload, setPayload] = useState({
        firstName: "",
        lastName: "",
        eMail: "",
    });
    const [errors, setErrors] = useState({});
    
    const handleChange = (e) => {
        const [name, value] = e.target;
        setPayload((prev) => ({...prev, [name] : value }))
    }

    return (
        <div className="huge-container mx-auto h-[70dvh] flex">
            <div className="my-auto px-20 py-10 w-full h-[2/3] flex flex-col justify-center md:flex-row">
                <div className="w-1/2 flex flex-col gap-y-32">
                    <div className="flex flex-col gap-y-10">
                        <p className="font-mer text-h1">Get In Touch</p>
                        <p className="font-mer text-h3 text-[--text-default]">We'd like to hear from you</p>
                        <p className="font-mer text-body text-[--text-default]">If you have any inquires or just want to say h, please use the contact form!</p>
                    </div>
                    <div className="flex flex-row gap-x-5">
                        <div className="flex flex-col gap-y-10">
                            <Mail className="w-8 h-8" />
                            <ExternalLink className="w-8 h-8" />
                        </div>
                        <div className="flex flex-col justify-between">
                            <a href="mailto:info@patisserie.com" className="font-mer text-body text-[--Pink-Primary] transition duration-300 hover:underline">info@patisserie.com</a>
                            <div className="flex flex-row justify-evenly">
                                <Instagram className="w-8 h-8" />
                                <Twitter className="w-8 h-8" />
                                <Youtube className="w-8 h-8" />                                    
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div className="w-1/2 flex justify-center items-center">
                    <form className="flex flex-col gap-y-5 p-5">
                        <div className="flex flex-row justify-center items-center gap-x-10">
                            <div className="flex flex-row items-center justify-between">
                                <div className="flex flex-col gap-y-3">
                                    <InputLabel htmlFor="firstName" value="FirstName"></InputLabel>
                                    <TextInput id="firstName" name="firstName" onChange={(e) => handleChange}></TextInput>
                                </div>
                            </div>
                            <div className="flex flex-col gap-y-3">
                                <InputLabel htmlFor="lastName" value="lastName"></InputLabel>
                                <TextInput id="lastName" name="lastName" onChange={(e) => handleChange(payload.lastName)}></TextInput>
                            </div>
                        </div>
                        <div className="flex flex-col gap-y-3">
                            <InputLabel htmlFor="email" value="email"></InputLabel>
                            <TextInput type="email" name="email" id="email" onChange={(e) => handleChange(payload.eMail)}></TextInput>
                        </div>
                        <div className="flex flex-col gap-y-3">
                            <InputLabel htmlFor="message" value="message"></InputLabel>
                            <textarea className="rounded-md border-gray-300 shadow-sm focus:border-[--Pink-Primary] focus:ring-[--Pink-Primary]"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}