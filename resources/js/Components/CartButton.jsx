import { useState, useEffect, use } from "react"
import { getCart } from '../Services/cart.service';
import { ShoppingBasket } from "lucide-react";
import { useCart } from "../context/CartContext";
 
/**
 * A Cart button which is fixed in the bottom right of pages which hold the chosen products of the authenticated user
 * 
 * A Cart Button intitially set as a rounded button with the icon cart in its
 * If there is not purchased product the cart can't be clicked 
 * Else if there is atleast a product, there will be a small badge carry the number of product detail 
 * + the user can clicked to the button that will expand the cart button into a region that will contain 
 * all products 
 * 
 * @component 
 * 
 * @return {JSX.Element} Rendered CartButton 
 */
export default function CartButton () {
    const [ isOpen, setIsOpen ] = useState(false);
    const { cartItems, fetchCart } = useCart();

    const toggleCart = () => {
        if (cartItems.length > 0) {
            setIsOpen(prev => !prev);
        }
    }
   
    useEffect(() => {
        if (cartItems.length > 0) {
            setIsOpen(false);
        }
    }, [cartItems]);
   
    console.log(isOpen);
    return (
        <>
            {isOpen ? (
                <div className="cart-content open">
                    <button className="close-cart" onClick={toggleCart}>X</button>
                </div>
            ) : (
                <button className="cart-button" onClick={toggleCart}>
                    <div className="relative inset-0">
                        {cartItems.length > 0 && (
                            <>
                            <ShoppingBasket></ShoppingBasket>
                            <span className="cart-badge">{cartItems.length}</span>
                            </>
                        )}
                    </div>
                </button>
            )}
        </>
    );
}