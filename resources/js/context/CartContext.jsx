import { useState, createContext, useEffect, useContext, Children} from 'react';
import { getCart } from '../Services/cart.service';
import { UserCheck } from 'lucide-react';

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

    return (
        <CartContext.Provider value={{ cartItems, setCartItems, fetchCart}}>
            {children}
        </CartContext.Provider>
    );
}

export const useCart = () => useContext(CartContext);

