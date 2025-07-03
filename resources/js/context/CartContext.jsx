import { useState, createContext, useEffect, useContext, Children} from 'react';
import { getCart, removeProductFromCart, updateProductQuantity } from '../Services/cart.service';


const CartContext = createContext();

export const CartProvider = ({children}) => {

    const [cartItems, setCartItems] = useState([]);
    const [total, setTotal] = useState(0.0);

    
    
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
        const updatedItem = await updateProductQuantity(productDetailId, amount, mode);

        setCartItems((prev) => {
            const newCartItems = prev
                .map((item) => {
                    if (item.id !== productDetailId) return item;

                    return { ...item, quantity: updatedItem.quantity, cost: updatedItem.cost };
                })
                .filter((item) => item.quantity > 0);

            const newTotal = newCartItems.reduce((sum, currentItem) => sum + currentItem.cost, 0.0);
            setTotal(newTotal);

            return newCartItems;
        });
    };

    const removeItem = async (productDetailId) => {
        await removeProductFromCart(productDetailId);

        setCartItems((prev) => {
            const updatedCartItems = prev.filter((item) => item.id !== productDetailId);
            const newTotal = updatedCartItems.reduce((sum, currentItem) => sum + currentItem.cost, 0.0);
            setTotal(newTotal);

            return updatedCartItems;
        });
    };
    

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

