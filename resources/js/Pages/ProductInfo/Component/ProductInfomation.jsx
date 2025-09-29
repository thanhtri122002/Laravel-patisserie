import { useProductInfo } from "../../../context/ProductInfoContext";
import { formatedCurrency } from "../../../utils/helpers";
import { motion } from "motion/react";
import PrimaryButton from "../../../Components/PrimaryButton";
import { addProductToCart } from "../../../Services/cart.service";

export default function ProductInfo() {
    const { product, loading } = useProductInfo();
    const handleProductToCart = async () => {
        await addProductToCart(productData.id, 1, productData.img);
    };

    return (
        <>
            {loading ? (
                <motion.div
                    animate={{ rotate: 360 }}
                    transition={{
                        repeat: Infinity,
                        repeatType: "loop",
                        duration: 1,
                        ease: "linear",
                    }}
                    className="w-10 h-10 border-4 border-t-transparent border-blue-500 rounded-full"
                ></motion.div>
            ) : (
                <div
                    initial={{ opacity: 0, y: -20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.4, ease: "easeOut" }}
                    className="w-full flex flex-col gap-6 bg-white rounded-2xl shadow-md p-6 " 
                >
                    <p className="font-mer text-h2 text-[--Pink-Primary] leading-snug">
                        {product.name}
                    </p>
                    <p className="font-mer text-h3 ">
                        <span className="font-mer">Category:</span>{" "}
                        {product.category?.name}
                    </p>
                    
                    <div className="flex flex-col gap-3">
                        <p className="font-mer text-body leading-relaxed line-clamp-6">
                            {product.description}
                        </p>
                        <p className="text-body">
                            <span className="font-mer text-gray text-h3">Price: </span>{" "}
                            <span className="text-h3 text-green-600">
                                {formatedCurrency(product.price)}
                            </span>
                        </p>
                        <p className="text-body text-gray-700">
                            <span className="font-mer">Stock:</span>{" "}
                            <span
                                className={`font-bold ${
                                    product.stock > 0
                                        ? "text-green-500"
                                        : "text-red-500"
                                }`}
                            >
                                {product.stock > 0
                                    ? product.stock
                                    : "Out of stock"}
                            </span>
                        </p>
                    </div>
                    <PrimaryButton
                        onClick={handleProductToCart}
                        disabled={product.stock === 0}
                        className="w-full md:w-40 h-12 flex justify-center items-center rounded-xl shadow hover:scale-105 transition"
                    >
                        <p className="font-mer text-body">
                            {product.stock === 0 ? "Sold Out" : "Add to Cart"}
                        </p>
                    </PrimaryButton>
                </div>
            )}
        </>
    );
}
