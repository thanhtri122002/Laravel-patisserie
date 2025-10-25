import React from "react";
import { createRoot } from "react-dom/client";
import LandingPage from "../Pages/Landing/LandingPage";

const container = document.getElementById('home-page-root');

if (container) {
    createRoot(container).render(<LandingPage />)
}