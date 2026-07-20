// import { useProductInfo } from "../../../context/ProductInfoContext";
// import { formatedCurrency } from "../../../utils/helpers";
// import { motion } from "motion/react";
// import PrimaryButton from "../../../Components/PrimaryButton";
// import usePublicChannel from "../../../hooks/usePublicChannel";
// import { useCallback } from "react";
// import { useCart } from "../../../context/CartContext";

// export default function ProductInfo() {
//     const { product, setData, loading } = useProductInfo();
//     const { addItem } = useCart(); 
    
//     const handleProductToCart = async () => {
//         await addItem(product.id, 1, product.img);
//     };

//     const handleStockUpdateEvent = useCallback((event) => {
//         console.log(event);
//         setData((prev) => ({ 
//             ...prev,
//             stock: event.stock 
//         }));
//     }, [setData]);

//     usePublicChannel('products', '.product.stock.updated', (event) => {
//         console.log(event);
//         handleStockUpdateEvent(event);
//     });

//     return (
//         <>
//             {loading ? (
//                 <motion.div
//                     animate={{ rotate: 360 }}
//                     transition={{
//                         repeat: Infinity,
//                         repeatType: "loop",
//                         duration: 1,
//                         ease: "linear",
//                     }}
//                     className="w-10 h-10 border-4 border-t-transparent border-blue-500 rounded-full"
//                 ></motion.div>
//             ) : (
//                 <div
//                     initial={{ opacity: 0, y: -20 }}
//                     animate={{ opacity: 1, y: 0 }}
//                     transition={{ duration: 0.4, ease: "easeOut" }}
//                     className="w-full flex flex-col gap-6 bg-white rounded-2xl shadow-md p-6 " 
//                 >
//                     <p className="font-mer text-h2 text-[--Pink-Primary] leading-snug">
//                         {product.name}
//                     </p>
//                     <p className="font-mer text-h3 ">
//                         <span className="font-mer">Category:</span>{" "}
//                         {product.category?.name}
//                     </p>
                    
//                     <div className="flex flex-col gap-3">
//                         <p className="font-mer text-body leading-relaxed line-clamp-6">
//                             {product.description}
//                         </p>
//                         <p className="text-body">
//                             <span className="font-mer text-gray text-h3">Price: </span>{" "}
//                             <span className="text-h3 text-green-600">
//                                 {formatedCurrency(product.price)}
//                             </span>
//                         </p>
//                         <p className="text-body text-gray-700">
//                             <span className="font-mer">Stock:</span>{" "}
//                             <span
//                                 className={`font-bold ${
//                                     product.stock > 10
//                                         ? "text-green-500"
//                                         : "text-red-500"
//                                 }`}
//                             >
//                                 {product.stock > 0
//                                     ? product.stock
//                                     : "Out of stock"}
//                             </span>
//                         </p>
//                     </div>
//                     <PrimaryButton
//                         onClick={handleProductToCart}
//                         disabled={product.stock === 0}
//                         className="w-full md:w-40 h-12 flex justify-center items-center rounded-xl shadow hover:scale-105 transition"
//                     >
//                         <p className="font-mer text-body">
//                             {product.stock === 0 ? "Sold Out" : "Add to Cart"}
//                         </p>
//                     </PrimaryButton>
//                 </div>
//             )}
//         </>
//     );
// }
'use client'

import { motion } from "motion/react";
import { useCallback } from "react";
import { useProductInfo } from "../../../context/ProductInfoContext";
import { formatedCurrency } from "../../../utils/helpers";
import PrimaryButton from "../../../Components/PrimaryButton";
import usePublicChannel from "../../../hooks/usePublicChannel";
import { useCart } from "../../../context/CartContext";

export default function ProductInfo() {
    const { product, setData, loading } = useProductInfo();
    const { addItem } = useCart(); 

    const handleProductToCart = async () => {
        await addItem(product.id, 1, product.img);
    };

    const handleStockUpdateEvent = useCallback((event) => {
        setData((prev) => ({
            ...prev,
            stock: event.stock,
        }));
    }, [setData]);

    usePublicChannel(
        'products',
        '.product.stock.updated',
        (event) => handleStockUpdateEvent(event)
    );

    if (loading) {
        return (
            <div className="flex justify-center items-center h-40">
                <motion.div
                    animate={{ rotate: 360 }}
                    transition={{
                        repeat: Infinity,
                        duration: 1,
                        ease: "linear",
                    }}
                    className="
                        w-10 h-10
                        border-4
                        border-[var(--Pink-Primary)]
                        border-t-transparent
                        rounded-full
                    "
                />
            </div>
        );
    }

    return (
        <motion.section
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.4, ease: "easeOut" }}
            className="
                w-full
                flex flex-col gap-8
                p-8
                rounded-2xl
                bg-[var(--section-light)]
                shadow-md
                font-mer
                text-[var(--text-default)]
            "
        >
            {/* Category */}
            <span
                className="
                    w-fit
                    px-4 py-1
                    rounded-full
                    text-sm font-semibold
                    bg-[var(--Pink-Secondary)]
                    text-[var(--Dusty-Mauve)]
                "
            >
                {product.category?.name}
            </span>

            {/* Product Name */}
            <h1
                className="
                    text-h2
                    leading-snug
                    text-[var(--Deep-Purple)]
                "
            >
                {product.name}
            </h1>

            {/* Price + Stock */}
            <div className="flex flex-wrap items-center gap-6">
                <p className="text-h3 font-bold text-[var(--Rich-Brown)]">
                    {formatedCurrency(product.price)}
                </p>

                <span
                    className={`
                        px-3 py-1 rounded-full text-sm font-semibold
                        ${
                            product.stock > 10
                                ? 'bg-[var(--Gray-Primary)] text-[var(--Muted-Blue)]'
                                : 'bg-[var(--alert-error-bg)] text-[var(--notification-badge)]'
                        }
                    `}
                >
                    {product.stock > 0
                        ? `${product.stock} in stock`
                        : 'Out of stock'}
                </span>
            </div>

            {/* Description */}
            <p
                className="
                    text-body
                    leading-relaxed
                    text-[var(--text-muted)]
                    max-w-prose
                "
            >
                {product.description}
            </p>

            {/* Divider */}
            <div className="h-px bg-[var(--Gray-Secondary)] opacity-40" />

            {/* CTA */}
            <PrimaryButton
                onClick={handleProductToCart}
                disabled={product.stock === 0}
                className="
                    w-full md:w-56 h-12
                    flex items-center justify-center
                    rounded-xl
                    transition
                    hover:scale-[1.02]
                "
            >
                <span className="text-body font-semibold">
                    {product.stock === 0 ? "Sold Out" : "Add to Cart"}
                </span>
            </PrimaryButton>
        </motion.section>
    );
}

/**
 * Note
 * 1/ Why you need (event) => handleStockUpdateEvent(event)
 *  You might think you can just pass handleStockUpdateEvent directly:
 *    usePublicChannel('products', '.product.stock.updated', handleStockUpdateEvent(event));
 *    but handleStockUpdateEvent(event) means calling the function, which CALL THE FUNCTION IMMEDIATELY
 *    at that time, you dont even have the event, which may lead to the undefine
 *   => Fix: define a function ref (event) => handleStockUpdateEvent(event)
 *           This tell when the broadcast happen, run this function - it will receive the event object and then call the handleStockUpdateEvent
 */