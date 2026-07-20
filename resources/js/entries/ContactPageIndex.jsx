import react from "react";
import { createRoot } from "react-dom/client";
import ContactPage from "../Pages/Contact/ContactPage";

const container = document.getElementById("contact-page-root");

if (container) {
    createRoot(container).render(
        <ContactPage />
    );
}