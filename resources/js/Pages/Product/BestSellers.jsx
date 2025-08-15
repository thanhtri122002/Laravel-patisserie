import { useState, useEffect } from "react";
import { getTopSellingProducts } from "../../Services/product.service";



export default function BestSellers ({ children, className, ...props }) {
    const [topSellingProducts, setTopSellingProducts] = useState([]);
    const [order, setOrder] = useState([]);
    const limit = 4;

    useEffect(() => {
        let isMounted = true;
        
        (async () => {
            const { data, errors } = await getTopSellingProducts(limit);

            if (!isMounted) return;
            setTopSellingProducts(data)
        })();
        console.log('This is the top selling products', topSellingProducts);
        return () => {
            isMounted = false;
        }
    }, []);

    useEffect(() => {
        if (topSellingProducts.length === 0) return;
        const order = Array.from({length: limit}, (_, i) => i)
        console.log(order);
        
    }, [order]);

    
}