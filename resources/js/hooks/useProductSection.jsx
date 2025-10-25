import { useState, useCallback } from "react";
import useProducts from "./useProducts";
import useCategories from "./useCategories";
import usePagination from "./usePagination";
/**
 * Custom React hook that manages the full logic for the product section,
 * including category filtering, search, price range filtering, and pagination.
 *
 * It composes several internal hooks (`useCategories`, `useProducts`, `usePagination`)
 * and exposes all the necessary state and handlers for building a dynamic
 * product listing UI.
 *
 * Features:
 * - Fetch and manage categories
 * - Select/deselect categories
 * - Manage search input
 * - Manage price range filter
 * - Handle pagination and auto-reset when filters change
 * - Fetch filtered products accordingly
 *
 * @returns {Object} An object containing product data, filters, pagination, loading state, and handlers.
 *
 * @property {Array} categories - List of available categories.
 * @property {Array|number[]} selectedCategoryId - Currently selected category IDs.
 * @property {Function} handleCategoryChange - Updates selected categories and resets pagination.
 * @property {Array} products - List of fetched products based on filters.
 * @property {Object} pagination - Pagination state (page, perPage, total, etc.).
 * @property {Function} onPageChange - Handler to change pages.
 * @property {[number, number]} priceRange - Current price range [min, max].
 * @property {Function} updatePriceRange - Updates the price range and resets pagination.
 * @property {string} searchInput - Current search value.
 * @property {Function} updateSearchInput - Updates search input and resets pagination.
 * @property {boolean} loading - Combined loading state for categories + products.
 * @property {string|null} error - Combined error from categories or products.
 *
 * @example
 * const {
 *   categories,
 *   selectedCategoryId,
 *   handleCategoryChange,
 *   products,
 *   searchInput,
 *   updateSearchInput,
 *   priceRange,
 *   updatePriceRange,
 *   pagination,
 *   onPageChange,
 *   loading,
 *   error,
 * } = useProductSection();
 */
export default function useProductSection() {
    
    const {
        categories,
        selectedCategoryId,
        handleUpdateSelectedCategory,
        loading: categoryLoading,
        error: categoryError,
    } = useCategories();

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
