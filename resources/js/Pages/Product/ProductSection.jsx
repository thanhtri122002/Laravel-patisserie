import Filter from "./Component/FilterCategories";
import ProductCard from "./Component/ProductCard";
import Pagination from "../../Components/Pagination";
import useProductSection from "../../../hooks/useProductSection";

export default function ProductSection() {

    const {
        categories,
        selectedCategoryId: selectedCategories,
        updateCategorySelection,
        products,
        pagination,
        onPageChange,
      } = useProductSection();

    return (
        <div className="flex gap-10">
          <div className="products-toolbars hidden md:flex gap-auto">
            <div></div>
          </div>
          <div className="main-content flex flex-col md:flex-row md:justify-between md:items-center w-full">
            <div className="main-content__filter md:w-1/4 p-4">
              <p className="text-h1 font-mer">Categories</p>
              <Filter
                categoryData={categories}
                selectedCategories={selectedCategories}
                onSelectedCategoriesChange={updateCategorySelection}
              />
            </div>
    
            <div className="main-content__filter-dropdown block md:hidden"></div>
    
            <div className="flex flex-col gap-3 md:w-auto ">
              {products.length > 0 ? (
                <div className="flex flex-col">
                  <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {products.map((product) => (
                      <ProductCard productData={product} key={product.id} />
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