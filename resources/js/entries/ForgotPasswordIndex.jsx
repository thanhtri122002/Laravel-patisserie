import React from 'react';
import { createRoot } from "react-dom/client";
import '../../scss/pages/auth/_auth.scss';
import ForgotPassword from '../Pages/Authentic/ForgotPassword';

const container = document.getElementById('forgot-password-root');

if (container) {
    createRoot(container).render(
       <ForgotPassword></ForgotPassword>
    );
}