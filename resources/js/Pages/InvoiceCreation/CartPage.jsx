import { Currency } from "lucide-react";
import { useCart } from "../../context/CartContext";

export default function CartPage () {

    const { cartItems, total, setCartItems, updateItem, removeItem, submitCart } = useCart()

    const NoItems = cartItems.length;
    const formatedTotal = total.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
    });
    
    return (
        <>
            
        </>
    )
}