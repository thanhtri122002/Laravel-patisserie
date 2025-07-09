import { useState, useEffect } from "react"
import { ShoppingBasket } from "lucide-react";
import { useCart } from "../context/CartContext";
import Modal from "../Components/MyCustomModal";
import CartProductDetail from "./CartProductDetail";
 
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
    const { cartItems, total, fetchCart } = useCart();
    
    const formatedTotal = total.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
    })

    const toggleCart = () => {
        if (cartItems.length > 0) {
            setIsOpen(prev => !prev);
        }
    }

    useEffect(() => {
        fetchCart();
    }, []);
    console.log(cartItems);

    return (
        <>
            {cartItems.length > 0 ? (
                isOpen ? (
                    <>
                        <div className="hidden md:block">
                            <div className={`cart-content ${isOpen ? "open" : ""}`}>
                                <button className="close-cart" onClick={toggleCart}>X</button>
                                {cartItems.map((cartItem) => (
                                    <CartProductDetail cartItemData={cartItem} key={cartItem.id}></CartProductDetail>
                                ))}
                                <p className="font-mer text-body self-end text-right">Total: {formatedTotal}</p>
                                <button className=""></button>
                            </div>
                            
                        </div>
                        <div className="block md:hidden">
                                <Modal open={isOpen} setIsOpen={setIsOpen} toggleOpen={toggleCart}>
                                    <Modal.Content>
                                        <button className="close-cart" onClick={toggleCart}>X</button>
                                        {cartItems.map((cartItem) => (
                                            <CartProductDetail cartItemData={cartItem} key={cartItem.id}></CartProductDetail>
                                        ))}
                                        <p className="font-mer text-body self-end text-right">Total: {formatedTotal}</p>
                                    </Modal.Content>
                                </Modal>
                        </div>
                    </>
                    
                    
                ) : (
                    <button className="cart-button" onClick={toggleCart}>
                        <div className="relative inset-0">
                        <ShoppingBasket className="" />
                        <span className="cart-badge">{cartItems.length}</span>
                    </div>
                </button>
                )
            ) : null}
        </>
    );
}

/**
 * 
 * <>
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
 */