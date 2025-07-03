import { CartProvider, useCart } from "../context/CartContext";
import { Trash2Icon } from "lucide-react";

export default function CartProductDetail ({cartItemData}) {
    
    const { updateItem, removeItem } = useCart();
    const formatedprice = Number(cartItemData.cost).toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    return (
        <>
            <div className="productDetail">
                <div className="productDetail__image">
                    <img src={cartItemData.product.product_images} className="w-full h-auto object-cover" alt="" />
                </div>
                <div className="productDetail__info ">
                    <div className="productDetail__name">{cartItemData.product.name}</div>
                    <div className="productDetail__quantity">
                        <button onClick={() => updateItem(cartItemData.id, -1, 'relative')}>-1</button>
                        <span className="">{cartItemData.quantity}</span>
                        <button onClick={() => updateItem(cartItemData.id, 1, 'relative')}>+1</button>
                    </div>
                    <p className="font-mer text-body">{formatedprice}</p>
                </div>
                <button className="productDetail__remove" onClick={() => removeItem(cartItemData.id)}>
                    <Trash2Icon className="text-black"></Trash2Icon>
                </button>
                
            </div>
        </>
    )
}