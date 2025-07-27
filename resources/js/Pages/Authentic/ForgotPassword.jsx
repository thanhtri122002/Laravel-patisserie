import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout";
import { useState } from "react";

export default function ForgotPassword () {
    
    const [email, setEmail] = useState('');

    const handleChange = (e) => {
        setEmail(e.target.value);
    }

    return (
        <AuthenticatedLayout>
           
        </AuthenticatedLayout>
    )
}
