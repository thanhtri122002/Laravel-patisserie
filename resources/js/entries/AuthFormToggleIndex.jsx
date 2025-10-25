import React from 'react';
import { createRoot } from "react-dom/client";
import AuthFormToggle from '../Pages/Authentic/AuthFormToggle';
import '../../scss/pages/auth/_auth.scss';

const container = document.getElementById('auth-form-toggle-root');

if (container) {
    createRoot(container).render(
        <AuthFormToggle>
            
        </AuthFormToggle>
    );
}