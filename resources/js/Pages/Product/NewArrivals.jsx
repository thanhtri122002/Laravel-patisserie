import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "motion/react";
import { getNewProducts } from "../../Services/product.service";

export default function NewArrivalSection ({ limit = 3, children, className, ...props }) {
    
    const [newProducts, setNewProducts] = useState([]);
    const [activeIndex, setActiveIndex] = useState(0);
    
    useEffect(() => {

        let isMounted = true;

        (async () => {
            const { data, errors } = await getNewProducts(limit);

            if (!isMounted) return;
            
            setNewProducts(data);

            
        })();

        return () => {
            isMounted = false;
        }
    }, [limit]);

    useEffect(() => {
        if (newProducts.length === 0 ) return;

        let timer = setInterval(() => {
            setActiveIndex((prevIndex) => (prevIndex + 1) % newProducts.length);
        }, 5000);

        return () => clearInterval(timer);
    }, [newProducts.length]);

    return (
        <div className={`px-4 ${className}`} {...props}>
            <p className="font-mer text-h2 font-bold mb-6">New Arrivals</p>

            <div className="relative h-96 overflow-hidden rounded-lg shadow-lg">
                <AnimatePresence mode="wait">
                    {newProducts.length > 0 && (
                        <motion.div
                            key={activeIndex}
                            initial={{ opacity: 0, x: 100 }}
                            animate={{ opacity: 1, x: 0 }}
                            exit={{ opacity: 0, x: -100 }}
                            transition={{ duration: 0.4, ease: "easeInOut" }}
                            className="absolute inset-0"
                        >
                            <img
                                src={newProducts[activeIndex].firstImage || "https://via.placeholder.com/800x400"}
                                alt={newProducts[activeIndex].name}
                                className="w-full h-full object-cover"
                            />
                            <div className="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent text-white p-4">
                                <h3 className="text-lg font-bold">{newProducts[activeIndex].name}</h3>
                                <p className="text-sm">{newProducts[activeIndex].description?.slice(0, 60)}...</p>
                            </div>
                        </motion.div>
                    )}
                </AnimatePresence>
            </div>
        </div>
    )

}