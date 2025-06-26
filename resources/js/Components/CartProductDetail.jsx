import { CartProvider } from "../context/CartContext";

export default function CartProductDetail ({id, quantity, productImg, total}) {
    return (
        <>
            <div className="w-full flex flex-col items-center justify-center">
                <div className="w-full flex flex-row justify-center items-center">
                    <p className="font-mer text-body">Image</p>
                    <p className="font-mer text-body">Qty</p>
                    <p className="font-mer text-body">Product</p>
                    <p className="font-mer text-body">Line total</p>
                </div>
                <div className="w-full flex flex-row justify-center items-center">
                    <div className="aspect-[3/2] h-24">
                        <img src={productImg} className="w-full h-auto object-cover" alt="" />
                    </div>

                </div>
            </div>
        </>
    )
}