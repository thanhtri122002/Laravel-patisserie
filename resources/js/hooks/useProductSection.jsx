import { useState, useCallback } from "react";
import useProducts from "./useProducts";
import useCategories from "./useCategories";
import usePagination from "./usePagination";


export default function useProductSection() {
    
    const {
        categories,
        selectedCategoryId,
        handleUpdateSelectedCategory,
        loading: categoryLoading,
        error: categoryError,
    } = useCategories();
    console.log(categories);
    const [searchInput, setSearchInput] = useState("");
    const [priceRange, setPriceRange] = useState([0.0, 1000000.0]);

    const { pagination, setPagination, onPageChange, resetPagination } = usePagination();

    const handleCategoryChange = useCallback(
        (selectedId, isChecked) => {
            handleUpdateSelectedCategory(selectedId, isChecked);
            resetPagination();
        },
        [handleUpdateSelectedCategory, resetPagination]
    );

    const updateSearchInput = useCallback(
        (input) => {
            setSearchInput(input);
            resetPagination();
        },
        [resetPagination]
    );

    const updatePriceRange = useCallback(
        (min, max) => {
            setPriceRange([min, max]);
            resetPagination();
        },
        [resetPagination]
    );

    
    const { products, loading: productLoading, error: productError } = useProducts(
        selectedCategoryId,
        priceRange,
        searchInput,
        pagination,
        setPagination
    );
    
    return {
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
        loading: categoryLoading || productLoading,
        error: categoryError || productError,
    };
}
