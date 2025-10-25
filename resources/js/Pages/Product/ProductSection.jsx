import Filter from "./Component/FilterCategories";
import ProductCard from "./Component/ProductCard";
import Pagination from "../../Components/Pagination";
import DualPriceRange from "./Component/DualPriceRange";
import useProductSection from "../../hooks/useProductSection";
import LoadingSpinner from "../../Components/LoadingSpinner";
export default function ProductSection() {
    const {
        categories,
        selectedCategoryId,
        handleCategoryChange,
        products,
        pagination,
        onPageChange,
        priceRange,
        updatePriceRange,
        searchInput,
        updateSearchInput,
        loading,
    } = useProductSection();

    return (
        <div className="product-section flex flex-col lg:flex-row gap-10 py-10">
            {/* Sidebar Filter */}
            <aside className="lg:w-1/4 w-full bg-[--White-Primary] border border-[--Pink-Primary]/20 shadow-lg rounded-3xl p-6 sticky top-24 h-fit">
                <p className="font-mer text-h1 text-center text-[--Pink-Primary] mb-6">
                    Filters
                </p>

                {/* Category Filter */}
                <div className="filter-category mb-8">
                    <p className="text-h2 font-mer text-[--Pink-Primary] mb-3">
                        Categories
                    </p>
                    <div className="p-4 bg-white/80 border border-[--Pink-Primary]/10 rounded-2xl shadow-inner">
                        <Filter
                            categoryData={categories}
                            selectedCategories={selectedCategoryId}
                            onSelectedCategoriesChange={handleCategoryChange}
                        />
                    </div>
                </div>

                {/* Price Range Filter */}
                <div className="filter-price mb-8">
                    <p className="text-h2 font-mer text-[--Pink-Primary] mb-3">
                        Price Range
                    </p>
                    <div className="p-4 bg-white/80 border border-[--Pink-Primary]/10 rounded-2xl shadow-inner">
                        <DualPriceRange
                            priceRange={priceRange}
                            updatePriceRange={updatePriceRange}
                        />
                    </div>
                </div>

                {/* Search Box */}
                <div className="filter-search">
                    <p className="text-h2 font-mer text-[--Pink-Primary] mb-3">
                        Search
                    </p>
                    <input
                        type="text"
                        placeholder="Search desserts..."
                        value={searchInput}
                        onChange={(e) => updateSearchInput(e.target.value)}
                        className="w-full px-4 py-2 border border-[--Pink-Primary]/30 rounded-full bg-white/70 focus:outline-none focus:ring-2 focus:ring-[--Pink-Primary]/50 transition"
                    />
                </div>
            </aside>

            {/* Product Grid */}
            <main className="lg:w-3/4 w-full flex flex-col gap-8">
                {loading ? (
                    <div className="flex justify-center items-center">
                        <LoadingSpinner />
                    </div>
                ) : products.length > 0 ? (
                    <>
                        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                            {products.map((product) => (
                                <ProductCard
                                    key={product.id}
                                    productData={product}
                                />
                            ))}
                        </div>

                        <Pagination
                            paginationData={pagination}
                            onPageChange={onPageChange}
                        />
                    </>
                ) : (
                    <div className="flex justify-center items-center h-64">
                        <p className="text-h2 font-mer text-[--Pink-Primary] text-center">
                            No products found 
                        </p>
                    </div>
                )}
            </main>
        </div>
    );
}
