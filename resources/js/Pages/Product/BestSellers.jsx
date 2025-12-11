import { useState, useEffect } from "react";
import { getTopSellingProducts } from "../../Services/product.service";
import { motion } from "motion/react";

function shuffle(array) {
    return array.sort(() => Math.random() - 0.5);
}
/**
 * Best Sellers Component
 *
 * Fetches the top-selling products and displays them in a dynamically
 * shuffled, animated grid using Motion layout transitions.
 *
 * @component
 *
 * @param {Object} props
 * @param {JSX.Element | JSX.Element[]} [props.children] - Optional children elements.
 * @param {string} [props.className] - Additional tailwind or custom class names.
 * @param {...any} props - Additional props passed to the root element.
 *
 * @state {Array<Object>} topSellingProducts - The fetched list of top sellers.
 *
 * @description
 * - Fetches top-selling products on mount.
 * - Every 3 seconds, the list is shuffled to trigger Motion layout animations.
 * - Uses a cleanup function to avoid state updates on unmounted components.
 *
 * @returns {JSX.Element} Animated list of best-selling products.
 */
export default function BestSellers ({ children, className, ...props }) {
    const [topSellingProducts, setTopSellingProducts] = useState([]);
    const limit = 4;

    useEffect(() => {
        let isMounted = true;
        
        (async () => {
            const { data, errors } = await getTopSellingProducts(limit);

            if (!isMounted) return;
            setTopSellingProducts(data)
        })();
        
        return () => {
            isMounted = false;
        }
    }, []);
    
    useEffect(() => {
        if (topSellingProducts.length === 0) return;

        const interval = setInterval(() => {
            
            setTopSellingProducts((prevProducts) => shuffle([...prevProducts]));
        }, 3000);

        return () => clearInterval(interval);
    }, [topSellingProducts.length]);


    return (
        <motion.ul
            layout
            style={{
                display: "flex",
                flexWrap: "wrap",
                gap: "1rem",
                listStyle: "none",
                padding: 0,
                margin: 0,
            }}
        >
            {topSellingProducts.map((product) => (
                <motion.li
                    key={product.id}
                    layout
                    transition={{ type: "spring", stiffness: 300, damping: 20 }}
                    style={{
                        flex: "0 0 48%", 
                        background: "#f5f5f5",
                        padding: "1rem",
                        borderRadius: "10px",
                        textAlign: "center",
                    }}
                >
                    {product.name}
                </motion.li>
            ))}
        </motion.ul>

    );
    
}