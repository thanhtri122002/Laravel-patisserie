import { useState, useEffect } from "react";
import { getTopSellingProducts } from "../../Services/product.service";
import { motion } from "motion/react";

function shuffle(array) {
    return array.sort(() => Math.random() - 0.5);
}

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