import react from "react";
import { createRoot } from "react-dom/client";

const container = document.getElementById('auth-form-toggle-root');

if (container) {
    createRoot(container).render();
}