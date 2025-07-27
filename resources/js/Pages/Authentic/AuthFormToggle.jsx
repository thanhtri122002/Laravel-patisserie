import { useState } from "react";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout";
import LoginForm from "./Login";
import RegisterForm from "./RegisterForm";
import Banner from "./Banner";

export default function AuthFormToggle ({ children }) {

    const [ isLogin, setIsLogin ] = useState(true);

    const togglingForm = () => {
        setIsLogin((prev) => !prev);
    }

    return (
        <AuthenticatedLayout>
            <div className='min-h-[50%] bg-red-50 rounded-xl flex flex-row items-center relative z-30'>
                <div className={`w-1/2 flex flex-row transition-opacity duration-1000 ${isLogin ? 'opacity-100' : 'opacity-0'}`}>
                    <LoginForm></LoginForm>
                </div>
                <div className={`w-1/2 flex flex-row transition-opacity duration-1000 ${isLogin ? 'opacity-0' : 'opacity-100'}`}>
                    <RegisterForm></RegisterForm>
                </div>
                <Banner isLogin={isLogin} togglingForm={togglingForm}></Banner>        
            </div>
           
        </AuthenticatedLayout>
    )
}