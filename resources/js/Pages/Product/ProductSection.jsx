import { useState, useCallback, useEffect } from "react";
import Filter from "./Component/FilterCategories";
import getCategories from "../../Services/category.service";
import { getProductsByCategories } from "../../Services/product.service";
import ProductCard from "./Component/ProductCard";
import Pagination from "../../Components/Pagination";

export default function ProductSection() {

    const [categories , setCategories] = useState([]);
    const [selectedCategories, setSelectedCategories] = useState([]);
    const [products, setProducts] = useState([]);
    const [pagination, setPagination] = useState({
        current_page: 1,
        last_page: 1,
        next_page_url: null,
        prev_page_url: null
    });

    const handleCategoryChange = useCallback((category, isChecked) => {
        setSelectedCategories((prev) => 
            isChecked ? [...prev, category] : prev.filter((id) => id !== category)
        );
    },[]);

    const onPageChange = useCallback((pageNumber) => {
        setPagination(prev => ({
            ...prev,
            current_page: pageNumber
        }));
    },[]);
    
    // console.log("selectedCategories:", selectedCategories);
    // console.log('products', products);
    console.log('pagination', pagination);
    useEffect(() => {
        const fetchCategories = async () => {
            const allCategories =  await getCategories();
            setCategories(allCategories.data);
        };
        fetchCategories();
    }, []);
    
    useEffect(() => {
        const fetchProducts = async () => {
            const justFirstImage = true;
            
            if (selectedCategories.length === 0) {
                setProducts([]); 
                return;
            }
            
            const productResponse = await getProductsByCategories(selectedCategories, pagination.current_page, justFirstImage);
            setProducts(productResponse.data.data);
            setPagination({
                current_page: productResponse.data.current_page,
                last_page: productResponse.data.last_page,
                total_items: productResponse.data.total,
                next_page_url: productResponse.data.next_page_url,
                prev_page_url: productResponse.data.prev_page_url,
            });
        };
        fetchProducts();
    },[selectedCategories, pagination.current_page]);

    console.log('products ádfasdfasd', products);

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
                <div className="flex flex-col gap-3 md:w-auto ">
                    {products.length > 0 && products ? (
                        <div className="flex flex-col">
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                {products.map((product) => (
                                    
                                    <ProductCard productData={product} key={product.id}></ProductCard>
                                ))} 
                            </div>
                            <Pagination className="" paginationData={pagination} onPageChange={onPageChange}></Pagination>
                        </div>
                    ) : (
                        <div className="flex justify-center items-center h-full">
                            <p className="text-h1 font-mer text-center">No Products Found</p>
                        </div>
                    )}
                    
                </div>
            
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