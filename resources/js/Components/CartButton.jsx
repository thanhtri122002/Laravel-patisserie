import { useState, useEffect } from "react"
import { ShoppingBasket } from "lucide-react";
import { useCart } from "../context/CartContext";
import Modal from "../Components/MyCustomModal";
import CartProductDetail from "./CartProductDetail";
import { motion, AnimatePresence } from "motion/react";
import { Minimize2 } from "lucide-react";
import PrimaryButton from "../Components/PrimaryButton";
/**
 * `CartButton` Component
 * 
 * A responsive, animated cart button component that allows users to view their selected products
 * and total cost. This button is fixed in the bottom right corner of the page and provides an 
 * expandable cart interface for both desktop and mobile views.
 *
 * ## Features:
 * - Displays a floating cart button with a badge showing the number of items.
 * - Opens an animated modal (on mobile) or a popover section (on desktop) containing cart items.
 * - Shows the total cost of all cart items formatted in Vietnamese Dong (VND).
 * - Uses `framer-motion` for smooth entry and exit animations.
 * - Hides the cart button if there are no items in the cart.
 *
 * ## Behavior:
 * - When `cartItems` is empty, the cart button is not shown.
 * - When clicked, if items exist, toggles visibility of the full cart view.
 * - Desktop and mobile views are rendered separately using conditional rendering.
 *
 * ## Dependencies:
 * - `lucide-react`: Icon rendering
 * - `framer-motion`: Animation for showing/hiding the cart
 * - `useCart`: Custom hook from `CartContext` providing `cartItems` and `total`
 * - `Modal`: Custom modal component for mobile layout
 * - `CartProductDetail`: Component to display individual product in cart
 *
 * @component
 * @example
 * return (
 *   <CartButton />
 * )
 *
 * @returns {JSX.Element} A rendered, animated cart button with expandable view
 */
export default function CartButton () {
    const [ isOpen, setIsOpen ] = useState(false);
    const { cartItems, total } = useCart();
    
    const formatedTotal = total.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
    })
    
    const toggleCart = () => {
        if (cartItems.length > 0) {
            setIsOpen(prev => !prev);
        }
    }

    return (
        <>  
            {cartItems.length > 0 && !isOpen && (
                <button className="cart-button" onClick={toggleCart}>
                    <div className="relative inset-0">
                        <ShoppingBasket className="" />
                        <span className="cart-badge">{cartItems.length}</span>
                    </div>
                </button>
            )}

            <AnimatePresence>
                {isOpen && (
                    <div className="hidden md:block">
                        <motion.div
                            key="desktop-cart"
                            initial={{ scale: 0 }}
                            animate={{ scale: 1 }}
                            exit={{ scale: 0 }}
                            style={{ transformOrigin: "bottom-right" }}
                            transition={{ duration: 0.3 }}
                            className="cart-content">
                                <div className="flex justify-between item-center mb-5">
                                    <p className="font-mer text-h3">Shopping Cart</p>
                                    <button className="close-cart " onClick={toggleCart}>
                                        <Minimize2 />
                                    </button>
                                </div>
                                
                                {cartItems.map((cartItem) => (
                                    <CartProductDetail cartItemData={cartItem} key={cartItem.id}></CartProductDetail>
                                ))}
                                <p className="font-mer text-body self-end text-right">Total: {formatedTotal}</p>
                                <PrimaryButton>
                                    <p className="font-mer text-body text-center">Submit the Cart</p>
                                </PrimaryButton>
                        </motion.div>
                    </div>
                )}
            </AnimatePresence>

            <AnimatePresence>
                {isOpen && (
                    <div className="block md:hidden">
                        <Modal open={isOpen} setIsOpen={setIsOpen} toggleOpen={toggleCart}>
                            <Modal.Content className="z-20 flex items-center justify-center">
                                <motion.div
                                    key="mobile-cart"
                                    initial={{ scale: 0 }}
                                    animate={{ scale: 1 }}
                                    exit={{ scale: 0 }}
                                    style={{ transformOrigin: "bottom-right" }}
                                    transition={{ duration: 0.3 }}
                                    className="w-full"
                                >
                                    <button className="close-cart" onClick={toggleCart}>X</button>
                                    {cartItems.map((cartItem) => (
                                        <CartProductDetail cartItemData={cartItem} key={cartItem.id} />
                                    ))}
                                    <p className="font-mer text-body self-end text-right">
                                        Total: {formatedTotal}
                                    </p>
                                </motion.div>  
                            </Modal.Content>
                        </Modal>
                    </div>
                )}
            </AnimatePresence>
        </>
    );
}
