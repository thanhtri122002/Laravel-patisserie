import { useCart } from "../../../context/CartContext";
import { formatedCurrency } from "../../../utils/helpers";
import CartItem from "./CartItem";
import QuantityButton from "../../../Components/QuantityButton";

export default function CartRow({ cartItem, className, ...props }) {
    const { updateItem, removeItem } = useCart();

    return (
        <tr className="border-b border-[--Gray-Secondary] hover:bg-[--Gray-Tertiary] transition-colors">
            <td>
                <CartItem
                    itemImage={cartItem.image}
                    itemName={cartItem.product}
                    itemCategory={cartItem.category}
                    itemPrice={cartItem.price}
                    itemDes={cartItem.description}
                ></CartItem>
            </td>
            <td className="px-4 py-3 text-center">{formatedCurrency(cartItem.price)}</td>
            <td>
                <QuantityButton productDetailId={cartItem.key} quantity={cartItem.quantity} handleUpdate={updateItem}></QuantityButton>
            </td>
            <td className="px-4 py-3 text-center">{formatedCurrency(cartItem.cost)}</td>
        </tr>
    );
}
