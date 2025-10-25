import React from "react";
import { createRoot } from "react-dom/client";
import { ProductInfoProvider } from "../context/ProductInfoContext";
import { CartProvider } from "../context/CartContext";
import ProductInfoPage from "../Pages/ProductInfo/ProductInfoPage";
const container = document.getElementById("product-info-page-root");

if (container) {
    const productId = container.dataset.productId;
    createRoot(container).render(
        <ProductInfoProvider productId={productId}>
            <CartProvider>
                <ProductInfoPage>
                    
                    
                </ProductInfoPage>
            </CartProvider>
        </ProductInfoProvider>
    );
}
