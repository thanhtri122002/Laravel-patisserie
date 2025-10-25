import React from "react";
import { createRoot } from "react-dom/client";
import App from "../Pages/Checkout/App";

const container = document.getElementById("checkout-page-root");

if (container) {
    createRoot(container).render(<App></App>);
}