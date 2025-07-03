import React from "react";

import { createRoot } from "react-dom/client";

import { CartProvider } from "./context/CartContext";

const modules = import.meta.glob([/
    '../Pages'
])