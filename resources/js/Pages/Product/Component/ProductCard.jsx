import { useCart } from "../../../context/CartContext";
import PrimaryButton from "../../../Components/PrimaryButton";
import { formatedCurrency, truncatedParagraph } from "../../../utils/helpers";
import { useCallback } from "react";

export default function ProductCard({ productData }) {
    const { addItem } = useCart();
    const handleProductToCart = async () => {
        await addItem(productData.id, 1, productData.img);
    };

    const truncatedDescription = truncatedParagraph(
        productData.description,
        30
    );
    console.log(productData.product_images);
    const getProductDetailpage = useCallback((id) => {
        window.location.href = `products/${id}`;
    }, []);

    return (
        <div
            className={`product-card flex flex-col bg-white shadow-lg rounded-2xl overflow-hidden hover:shadow-xl transition-shadow duration-300 ${productData.stock === 0 ? "opacity-70" : ""
                }`}
        >
        <div className="product-card__img-container relative z-10 aspect-square">
                <img
                    className="w-full h-full object-cover"
                    src={
                        `/storage/${productData.product_images?.[0]?.url}`
                        // productData.product_images?.[0]
                        //     ? productData.product_images[0]
                        //     : "https://placehold.co/160x160"
                    }
                    alt={productData.name}
                />
                {productData.stock === 0 && (
                    <div className="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <p className="font-mer text-h3 text-white bg-red-500 px-4 py-2 rounded-lg">
                            Out of Stock
                        </p>
                    </div>
                )}
            </div>

            <div className="flex flex-col flex-1 p-4 gap-2">
                <h3 className="product-card__name text-lg font-mer font-semibold line-clamp-1 text-[--text-default]">
                    {productData.name}
                </h3>
                <p className="product-card__detail text-body text-[--text-muted] line-clamp-2">
                    {truncatedDescription}
                </p>
            </div>

            <div className="product-card__footer flex items-center justify-between gap-3 px-4 py-3 border-t border-[--Gray-Secondary]">
                <p className="product-card__price text-body text-[--Deep-Purple]">
                    {formatedCurrency(productData.price)}
                </p>

                <PrimaryButton
                    onClick={handleProductToCart}
                    className={`rounded-full px-2 py-1 ${productData.stock === 0 && "pointer-events-none"}`}
                >
                    Add
                </PrimaryButton>
            </div>

            <PrimaryButton
                className="w-full rounded-none rounded-b-2xl bg-[--btn-secondary-bg] hover:bg-[--btn-secondary-hover] text-[--text-contrast] py-2 transition-colors"
                onClick={() => getProductDetailpage(productData.id)}
            >
                <p className="font-mer text-sm">View Details</p>
            </PrimaryButton>
        </div>
    );
}
