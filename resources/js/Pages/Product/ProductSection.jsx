import Filter from "./Component/FilterCategories";
import ProductCard from "./Component/ProductCard";
import Pagination from "../../Components/Pagination";
import DualPriceRange from "./Component/DualPriceRange";
import useProductSection from "../../hooks/useProductSection";

export default function ProductSection() {
    const {
        categories,
        selectedCategoryId: selectedCategories,
        handleUpdateSelectedCategory,
        products,
        pagination,
        onPageChange,
        priceRange,
        updatePriceRange,
        searchInput,
        updateSearchInput,
    } = useProductSection();

    return (
        <div className="flex gap-10 mt-5">
            <div className="main-content flex flex-col md:flex-row md:items-center md:gap-10 w-full">
                {/* Sidebar Filter */}
                <div className="main-content__filter md:self-start md:flex md:flex-col md:w-1/4 p-4">
                    <p className="font-mer text-h1">Filters</p>
                    <div className="h-[0.125rem] w-[70%] bg-[--Pink-Primary]"></div>
                    <div className="flex flex-col gap-3 mt-5">
                        <p className="text-h2 font-mer text-[--Pink-Primary]">Categories</p>
                        <Filter
                            categoryData={categories}
                            selectedCategories={selectedCategories}
                            onSelectedCategoriesChange={
                                handleUpdateSelectedCategory
                            }
                        />
                    </div>
                    <div className="flex flex-col gap-3 mt-5">
                        <p className="text-h2 font-mer text-[--Pink-Primary]">Price</p>
                        <DualPriceRange
                            className="mt-3"
                            priceRange={priceRange}
                            updatePriceRange={updatePriceRange}
                        ></DualPriceRange>
                    </div>
                    
                    <div className="flex flex-col gap-3 mt-[3.75rem]">
                        <p className="text-h2 font-mer text-[--Pink-Primary]">Search</p>
                        <input
                            type="text"
                            placeholder="Search"
                            onChange={(e) => updateSearchInput(e.target.value)}
                        />
                    </div>
                    
                </div>

                {/* Mobile Filter Dropdown Placeholder */}
                {/* <div className="main-content__filter-dropdown block md:hidden">
                    <p className="font-mer text-h1">Categories</p>
                </div> */}

                {/* Product List & Pagination */}
                <div className="flex flex-col gap-3 md:w-auto">
                    {products.length > 0 ? (
                        <div className="flex flex-col w-auto">
                            <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                                {products.map((product) => (
                                    <ProductCard
                                        productData={product}
                                        key={product.id}
                                    />
                                ))}
                            </div>
                            <Pagination
                                className=""
                                paginationData={pagination}
                                onPageChange={onPageChange}
                            />
                        </div>
                    ) : (
                        <div className="flex justify-center items-center h-full">
                            <p className="text-h1 font-mer text-center">
                                No Products Found
                            </p>
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
