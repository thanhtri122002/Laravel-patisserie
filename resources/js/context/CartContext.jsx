import { useState, createContext, useEffect, useContext } from "react";
import {
    getCart,
    addProductToCart,
    removeProductFromCart,
    updateProductQuantity,
    createInvoice,
} from "../Services/cart.service";

const CartContext = createContext();

/**
 * CartProvider Context
 *
 * A context used to stores, manipulate and pass an user's cart to other component
 *
 * Props:
 * @params {React.ReactNode} props.chilren - the child nodes that will have access to the cart context
 *
 * Interal State:
 * @state {array} cartItems - The product detail belong to an user's cart
 * @state {float} total - the total cost of that cart which is the sum of cost of each product detail
 *
 * Functions:
 * @function fetchCart - use to fetch the cart detail which includes the detail of the cart (productDetails and the total cost)
 * @function updateItem - use to update an item in the cart by calling to the server and then update the cartItems and total states
 * @function removeItem - use to delete an item in the cart by calling to the server and then udpate the cartItems and total state
 * @function submitCart - submit the cart
 *
 * @param {React.ReactNode} children
 * @returns
 */
export const CartProvider = ({ children }) => {
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

    const addItem = async (productId, quantity = 1, productImage) => {
        const newItem = await addProductToCart(productId, quantity, productImage);
        console.log(newItem);
        setCartItems((prev) => {
          
            const exists = prev.some((item) => item.product_id === newItem.product_id);
    
            if (!exists) {
                return [...prev, newItem];
            }
    
            return prev.map((item) =>
                item.product_id === newItem.product_id
                    ? { ...item, quantity: item.quantity + quantity }
                    : item
            );
        });
    };
    

    const updateItem = async (productDetailId, amount, mode) => {
        const updatedItem = await updateProductQuantity(
            productDetailId,
            amount,
            mode
        );

        setCartItems((prev) => {
            const newCartItems = prev
                .map((item) => {
                    if (item.id !== productDetailId) return item;

                    return {
                        ...item,
                        quantity: updatedItem.quantity,
                        cost: updatedItem.cost,
                    };
                })
                .filter((item) => item.quantity > 0);

            const newTotal = newCartItems.reduce(
                (sum, currentItem) => sum + parseFloat(currentItem.cost),
                0.0
            );
            setTotal(newTotal);

            return newCartItems;
        });
    };

    const removeItem = async (productDetailId) => {
        await removeProductFromCart(productDetailId);

        setCartItems((prev) => {
            const updatedCartItems = prev.filter(
                (item) => item.id !== productDetailId
            );
            const newTotal = updatedCartItems.reduce(
                (sum, currentItem) => sum + parseFloat(currentItem.cost),
                0.0
            );
            setTotal(newTotal);

            return updatedCartItems;
        });
    };

    const submitCart = async () => {
        await createInvoice();
    };

    return (
        <CartContext.Provider
            value={{
                cartItems,
                total,
                setCartItems,
                fetchCart,
                addItem,
                updateItem,
                removeItem,
                submitCart,
            }}
        >
            {children}
        </CartContext.Provider>
    );
};

export const useCart = () => useContext(CartContext);
