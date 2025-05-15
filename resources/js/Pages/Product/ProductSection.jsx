import { useState, useCallback, useEffect } from "react";
import Filter from "./Component/FilterCategories";
import getCategories from "../../Services/category.service";
import getProductsByCategories from "../../Services/product.service";
import ProductCard from "./Component/ProductCard";


export default function ProductSection() {

    const [categories , setCategories] = useState([]);
    const [selectedCategories, setSelectedCategories] = useState([]);
    const [products, setProducts] = useState([]);
    
    const handleCategoryChange = useCallback((category, isChecked) => {
        if (isChecked) {
            setSelectedCategories(prev => [...prev, category]);
        }
        else {
            setSelectedCategories((prev) => prev.filter((id) => id !== category));
        }
    },[])
    
    useEffect(() => {
        const fetchCategories = async () => {
            const allCategories =  await getCategories();
            console.log("allCategories has been retrieved:", allCategories);
            setCategories(allCategories.data);
        };
        fetchCategories();
    }, []);

    
    useEffect(() => {
        const fetchProducts = async () => {
            if (selectedCategories.length === 0) {
                setProducts([]); // Clear products if no categories are selected
                return;
            }

            const allProducts = await getProductsByCategories(selectedCategories);
            console.log("allProducts has been retrieved:", allProducts);
            setProducts(allProducts.data.data);
        };
        fetchProducts();
    },[selectedCategories]);
    
    return (
        <div className="flex gap-10">
            <div className="products-toolbars hidden md:flex gap-auto">
                <div></div>
            </div>
            <div className="main-content flex flex-col md:flex-row md:justify-between md:items-center w-full">
                <div className="main-content__filter md:w-1/4 p-4">
                    <p className="text-h1 font-mer">Categories</p>
                    <Filter categoryData={categories} isSelected={handleCategoryChange}></Filter>
                </div>
                
                <div className="main-content__filter-dropdown block md:hidden">
                    
                </div>
                {products.length > 0 ? (
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {products.map((product) => (
                           <ProductCard productData={product} key={product.id}></ProductCard>
                        ))}
                    </div>
                ) : (
                    <div className="flex justify-center items-center h-full">
                        <p className="text-h1 font-mer text-center">No Products Found</p>
                    </div>
                )}
            </div>
        </div>
    );
}

/**
 * Note:
 * 1/ The key attribute is used to give each element a unique identifier, 
 *    which helps React identify which items have changed, are added, or are removed.
 * 2/ UseCallback hook is used to cachced a function instance, so if the function is CALLED AGAIN
 *    with the SAME PARAMETERS, it will return the cached instance instead of creating a new one.
 * 3/ Memoization is a technique  used to cached the result of a function, value of a variable 
 *    or the return value of a component, so that it doesn't have to be recalculated every time. 
 * 4/ 
 */