import { div } from "motion/react-client";
import { useCart } from "../context/CartContext";
import { Plus, Minus } from "lucide-react";

export default function QuantityButton({
    productDetailId,
    quantity,
    handleUpdate,
}) {
    return (
        <div
            className="flex items-center justify-between
                       rounded-full bg-[--Pink-Secondary] text-[--Deep-Purple] "
        >
            <button
                className="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[--Pink-Primary] hover:text-white transition-colors"
                onClick={() => handleUpdate(productDetailId, -1, "relative")}
            >
                <Minus size={16} />
            </button>
            <input
                type="number"
                min={1}
                value={quantity}
                onChange={(e) =>
                    handleUpdate(
                        productDetailId,
                        Number(e.target.value),
                        "absolute"
                    )
                }
                className="w-12 text-center font-medium bg-transparent
                            border-x border-[--Gray-Secondary] 
                            focus:outline-none focus:ring-2 focus:ring-[--Pink-Primary] focus:border-[--Pink-Primary]
                            [appearance:textfield] 
                            [&::-webkit-outer-spin-button]:appearance-none 
                            [&::-webkit-inner-spin-button]:appearance-none"
            />
            <button
                className="w-8 h-8 flex items-center justify-center rounded-full hover:bg-[--Pink-Primary] hover:text-white transition-colors"
                onClick={() => handleUpdate(productDetailId, 1, "relative")}
            >
                <Plus size={16} />
            </button>
        </div>
    );
}
