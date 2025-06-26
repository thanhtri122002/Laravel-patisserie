import { useState, createContext, useEffect, useContext, Children} from 'react';
import { getCart, removeProductFromCart, updateProductQuantity } from '../Services/cart.service';


const CartContext = createContext();

export const CartProvider = ({children}) => {

    const [cartItems, setCartItems] = useState([]);

    const fetchCart = async () => {
        
        const items = await getCart();
        if (items) setCartItems(items);
    };

    useEffect(() => {
        fetchCart();
    }, []);

    const updateItem = async (productDetailId, quantity) => {
        await updateProductQuantity(productDetailId, quantity);

        setCartItems((prev) => 
            prev.map((item) => 
                item.id === productDetailId ? {...item, quantity} : item
            )    
        )
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
        <CartContext.Provider value={{ cartItems, setCartItems, fetchCart, updateItem, removeItem}}>
            {children}
        </CartContext.Provider>
    );
}

export const useCart = () => useContext(CartContext);

