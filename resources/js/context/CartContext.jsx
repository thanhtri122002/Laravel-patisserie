import { useState, createContext, useEffect, useContext, Children} from 'react';
import { getCart, removeProductFromCart, updateProductQuantity } from '../Services/cart.service';


const CartContext = createContext();

export const CartProvider = ({children}) => {

    const [cartItems, setCartItems] = useState([]);
    const [total, setTotal] = useState(0);
    console.log(cartItems);

    
    const fetchCart = async () => {
        
        const cartInfo = await getCart();

        if (cartInfo.cart) {
            setCartItems(cartInfo.cart);
            setTotal(cartInfo.total);
        } 
    };

    useEffect(() => {
        
        fetchCart();
    }, []);

    const updateItem = async (productDetailId, amount, mode) => {
        await updateProductQuantity(productDetailId, amount, mode);

        setCartItems((prev) => {

            return prev.map((item) => {
                
                if (item.id !== productDetailId) return item;

                const newQuantity = 
                    mode === 'relative' 
                        ? Math.max(1, item.quantity + amount)
                        : Math.max(1, amount);
                
                return {...item, quantity: newQuantity};
            });
        });
    }

    const removeItem = async (productDetail) => {
        await removeProductFromCart(productDetail);

        setCartItems((prev) =>
            prev.filter((item) => item.id !== productDetailId)
        )
    }

    const submitCart = async() => {
        
        await submitCart();
    }

    return (
        <CartContext.Provider value={{ cartItems, total, setCartItems, fetchCart, updateItem, removeItem}}>
            {children}
        </CartContext.Provider>
    );
}

export const useCart = () => useContext(CartContext);

