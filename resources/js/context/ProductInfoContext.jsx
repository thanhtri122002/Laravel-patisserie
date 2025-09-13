import { useState, useEffect, useContext, createContext } from "react";
import { getProduct } from "../Services/product.service";

const ProductContext = createContext();

export const ProductInfoProvider = ({ productId, children }) => {
    const [product, setProduct] = useState({});
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        let isMounted = true;
        
        (async () => {
            setLoading(true);
            const { data, err } = await getProduct(productId);

            if (!isMounted) return;
            setProduct(data.data);
            setLoading(false);
        })();

        return () => {
            isMounted = false;
        };
    }, [productId]);
    
    return (
        <ProductContext.Provider value={{product, loading}}>
            {children}
        </ProductContext.Provider>
    );
};

export const useProductInfo = () => useContext(ProductContext);
