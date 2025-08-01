import { useState } from "react";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout";
import LoginForm from "./Login";
import RegisterForm from "./RegisterForm";
import DynamicAuthForm from "./DynamicAuthForm";
import Banner from "./Banner";

export default function AuthFormToggle () {

    const [ isLogin, setIsLogin ] = useState(true);

    const togglingForm = () => {
        setIsLogin((prev) => !prev);
    }

    return (
        <AuthenticatedLayout>
                
                <div className="hidden md:w-full md:h-full md:flex md:items-center md:justify-center md:relative md:z-30">
                    <div className='bg-red-50 rounded-xl flex flex-row items-center relative py-10'>
                        <div className={`w-1/2 flex flex-row transition-opacity duration-1000 ${isLogin ? 'opacity-100' : 'opacity-0'}`}>
                            <LoginForm></LoginForm>
                        </div>
                        <div className={`w-1/2 flex flex-row transition-opacity duration-1000 ${isLogin ? 'opacity-0' : 'opacity-100'}`}>
                            <RegisterForm></RegisterForm>
                        </div>
                        <Banner isLogin={isLogin} togglingForm={togglingForm}></Banner>        
                    </div>
                </div>

                <div className="block w-full h-full relative z-30 bg-red-50 md:hidden">
                    <DynamicAuthForm isLogin={isLogin} onTogglingForm={togglingForm}></DynamicAuthForm>
                </div>
        </AuthenticatedLayout>
    )
}