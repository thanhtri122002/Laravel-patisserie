import React from 'react';
import { createRoot } from "react-dom/client";
import AuthenticatedToggleLayout from "../Layouts/AuthenticatedToggleLayout";
import AuthFormToggle from '../Pages/Authentic/AuthFormToggle';

const container = document.getElementById('auth-form-toggle-root');

if (container) {
    createRoot(container).render(
        <AuthFormToggle>

        </AuthFormToggle>
    );
}