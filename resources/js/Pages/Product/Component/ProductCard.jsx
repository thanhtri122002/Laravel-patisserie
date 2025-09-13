import { addProductToCart } from "../../../Services/cart.service";
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

    const getProductDetailpage = useCallback((id) => {
        window.location.href = `products/${id}`;
    }, []);

    return (
        <div className="product-card flex flex-col bg-white shadow-lg rounded-2xl overflow-hidden hover:shadow-xl transition-shadow duration-300">
            {/* Image Section */}
            <div className="product-card__img-container relative aspect-square">
                <img
                    className="w-full h-full object-cover"
                    src={
                        productData.product_images?.[0]
                            ? productData.product_images[0]
                            : "https://placehold.co/300"
                    }
                    alt={productData.name}
                />
            </div>

            {/* Content Section */}
            <div className="flex flex-col flex-1 p-4 gap-2">
                <h3 className="product-card__name text-lg font-mer font-semibold line-clamp-1 text-[--text-default]">
                    {productData.name}
                </h3>
                <p className="product-card__detail text-body text-[--text-muted] line-clamp-2">
                    {truncatedDescription}
                </p>
            </div>

            {/* Footer Section */}
            <div className="product-card__footer flex items-center justify-between gap-3 px-4 py-3 border-t border-[--Gray-Secondary]">
                <p className="product-card__price text-body text-[--Deep-Purple]">
                    {formatedCurrency(productData.price)}
                </p>
                <PrimaryButton
                    onClick={handleProductToCart}
                    className="rounded-full px-2 py-1"
                >
                    Add
                </PrimaryButton>
            </div>

            {/* Detail Button */}
            <PrimaryButton
                className="w-full rounded-none rounded-b-2xl bg-[--btn-secondary-bg] hover:bg-[--btn-secondary-hover] text-[--text-contrast] py-2 transition-colors"
                onClick={() => getProductDetailpage(productData.id)}
            >
                <p className="font-mer text-sm">View Details</p>
            </PrimaryButton>
        </div>
    );
}
