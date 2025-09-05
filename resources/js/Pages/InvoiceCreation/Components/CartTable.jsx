import { useCart } from "../../../context/CartContext";
import CartRow from "./CartRow";

export default function CartTable({ children, className, ...props }) {
    const { cartItems } = useCart();
    
    const mappedItems = cartItems.map((item, index) => ({
        key: item.id ?? index,
        product: item.product.name,
        price: item.product.price,
        quantity: item.quantity,
        image: item.product.product_images?.[0]
            ? item.product.product_images?.[0]
            : "https://placehold.co/160",

        category: item.product.category.name,
        description: item.product.description,
        cost: item.cost,
    }));
    console.log("this is the cart Items:", mappedItems);
    return (
        <table className={`w-full table-auto ` + className}>
            <thead className="bg-[--Pink-Secondary] text-[--Deep-Purple] uppercase tracking-wide">
                <tr className="font-mer text-body ">
                    <th className="px-4 py-3 text-left">Item</th>
                    <th className="px-4 py-3 text-left">Price</th>
                    <th className="px-4 py-3 text-left">Quantity</th>
                    <th className="px-4 py-3 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                {mappedItems.map((item) => (
                    <CartRow key={item.key} cartItem={item}></CartRow>
                ))}
            </tbody>
        </table>
    );
}
