import { useContext, createContext } from "react";
import { getProduct } from "../Services/product.service";
import useFetch from "../hooks/useFetch";

const ProductContext = createContext();

export const ProductInfoProvider = ({ productId, children }) => {
    const { data: product, setData, loading, error } = useFetch(getProduct, null, productId);

    return (
        <ProductContext.Provider value={{ product, setData, loading }}>
            {children}
        </ProductContext.Provider>
    );
};

export const useProductInfo = () => useContext(ProductContext);
