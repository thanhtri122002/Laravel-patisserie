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
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.4, ease: "easeOut" }}
                    className="w-full flex flex-col gap-5"
                >
                    <p className="font-mer text-h2">{product.name}</p>
                    <p className="font-mer text-h3">
                        Category: {product.category.name}
                    </p>
                    <div className="flex flex-col gap-3">
                        <p className="font-mer text-body line-clamp-6">
                            {product.description}
                        </p>
                        <p className="text-body">
                            <span className="font-mer">Price: </span>{" "}
                            {formatedCurrency(product.price)}
                        </p>
                        <p className="text-body">
                            {" "}
                            <span className="font-mer">
                                Currently stock:
                            </span>{" "}
                            {product.stock}
                        </p>
                    </div>
                    <PrimaryButton
                        onClick={handleProductToCart}
                        className="w-20 flex justify-center items-center"
                    >
                        <p className="font-mer text-body">Add</p>
                    </PrimaryButton>
                </motion.div>
            )}
        </>
    );
}
