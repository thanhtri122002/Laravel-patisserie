import { useState } from "react";

export default function ProductSection() {

    const [categories , setSelectedCategories] = useState([]);

    handleCategoryChange = (category, isChecked) => {
        if (isChecked) {
            setSelectedCategories([...categories, category]);
        }
        else {
            setSelectedCategories([categories.filter((c) => c !== category)]);
        }
    };

    return (
        <div class="flex gap-10">
            <div class="products-toolbars hidden md:flex gap-auto">
                <div></div>
            </div>
            <div class="main-content flex flex-col md:flex-row w-full">
                <div class="main-content__filter w-full md:w-1/4 p4">
                    <p class="text-h1 font-mer">Categories</p>
                </div>
                <!-- filter section for the mobile -->
                <div class="main-content__filter-dropdown block md:hidden">

                </div>
                <div class="main-content__products w-full md:w-3/4 p-4">
                    
                </div>
            </div>
        </div>
    );
}