import { useState } from "react";
import AuthenticatedToggleLayout from "../../Layouts/AuthenticatedToggleLayout";
import LoginForm from "./Login";
import RegisterForm from "./RegisterForm";
import Banner from "./Banner";

export default function AuthFormToggle ({ children }) {

    const [ isLogin, setIsLogin ] = useState(true);

    const togglingForm = () => {
        setIsLogin((prev) => !prev);
    }

    return (
        <AuthenticatedToggleLayout isLogin={isLogin}>
            <div className="basis-1/2">
                <LoginForm></LoginForm>
            </div>

            <div className="basis-1/2">
                <RegisterForm></RegisterForm>
            </div>
            
            <div className="absolute">
                <Banner isLogin={isLogin}></Banner>
            </div>
        </AuthenticatedToggleLayout>
    )
}