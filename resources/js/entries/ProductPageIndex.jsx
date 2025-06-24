import React from 'react';
import { createRoot } from 'react-dom/client';
import ProductPage from '../Pages/Product/ProductPage';
import { CartProvider } from '../context/CartContext';

const container = document.getElementById('product-page-root');

if (container) {
  createRoot(container).render(
    <CartProvider>
      <ProductPage />
    </CartProvider>
  );
}
