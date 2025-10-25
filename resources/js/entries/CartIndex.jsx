import React from "react";
import { createRoot } from "react-dom/client";
import { CartProvider } from "../context/CartContext";
import CartPage from "../Pages/InvoiceCreation/CartPage";

const container = document.getElementById('cart-page-root');

if (container) {
    createRoot(container).render(
        <CartProvider>
            <CartPage></CartPage>
        </CartProvider>
    )
}