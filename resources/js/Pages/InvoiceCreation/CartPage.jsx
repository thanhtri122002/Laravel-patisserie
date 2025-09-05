import { useCart } from "../../context/CartContext";
import CartTable from "./Components/CartTable";
import { formatedCurrency } from "../../utils/helpers";

export default function CartPage() {
    const { cartItems, total, submitCart } = useCart();

    return (
        <>
            <div className="w-full">
                <div className="xs-container mx-auto flex flex-col gap-5">
                    <h1 className="text-center font-mer text-h1">Your Cart</h1>
                    <CartTable className=""></CartTable>
                    <div className="cart-info self-end text-[--Deep-Purple] flex flex-col ">
                        <div className="flex flex-row justify-between items-center">
                            <p className="font-mer text-h3">Items: </p>
                            <p className="text-h3">{cartItems.length}</p>
                        </div>
                        <div className="flex flex-row gap-10 justify-between items-center">
                            <p className="font-mer text-h3">Total cost: </p>
                            <p className="text-h3">{formatedCurrency(total)}</p>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
