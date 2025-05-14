import { useState } from "react";
import { useEffect } from "react";
import Filter from "./FilterCategories";
import getCategories from "../../Services/category.service";
import getProductsByCategories from "../../Services/product.service";


export default function ProductSection() {

    const [categories , setCategories] = useState([]);
    const [selectedCategories, setSelectedCategories] = useState([]);
    const [products, setProducts] = useState([]);
    
    const handleCategoryChange = (category, isChecked) => {
        if (isChecked) {
            setSelectedCategories(prev => [...prev, category]);
        }
        else {
            setSelectedCategories(prev => prev.filter(id => id !== category));
        }
    };
    
    useEffect(() => {
        const fetchCategories = async () => {
            const allCategories =  await getCategories();
            setCategories(allCategories);
        };
        fetchCategories();
    }, []);

    useEffect(() => {
        const fetchProducts = async () => {
            const allProducts = await getProductsByCategories(selectedCategories);
            setProducts(allProducts);
        };
        fetchProducts();
    },[selectedCategories]);
    console.log(products);

    return (
        <div class="flex gap-10">
            <div class="products-toolbars hidden md:flex gap-auto">
                <div></div>
            </div>
            <div class="main-content flex flex-col md:flex-row w-full">
                <div class="main-content__filter w-full md:w-1/4 p4">
                    <p class="text-h1 font-mer">Categories</p>
                </div>
                

                <div class="main-content__filter-dropdown block md:hidden">
                    <Filter categoryData={categories} isSelected={handleCategoryChange}></Filter>
                </div>
                <div class="main-content__products w-full md:w-3/4 p-4">
                    <ProductCard></ProductCard>
                </div>
            </div>
        </div>
    );
}