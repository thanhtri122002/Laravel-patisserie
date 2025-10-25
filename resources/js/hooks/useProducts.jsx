import { useState, useCallback, useMemo } from "react";
import { debounce } from "../utils/helpers";
import { getProducts } from "../Services/product.service";
import useFetch from "./useFetch";
/**
 * Custom react hook to fetch and filter the products 
 * 
 * This hook uses a debounced 'getProducts' service to reduce unecessary api calls
 * when the user adjust the filter
 * It also updates local products state and optionally updated the pagination state
 * 
 * @param {Array<number>} selectedCategoryId - Array of selected category ids
 * @param {Array<number>} priceRange - array contain the min and the max price
 * @param {string} searchInput - the search input
 * @param {Object} pagination - the pagination state object which is created based on Laravel pagination 
 * @param {Function} setPagination - function to update the pagination state
 * @returns {Object} an Object containing:
 *   @property {Array} products - The current list of fetched products.
 *   @property {any} data - Raw API response returned from the `getProducts` service.
 *   @property {boolean} loading - Indicates if the data is currently being fetched.
 *   @property {Error|null} error - Any error encountered during the fetch.
 * 
 * @example
 * const { products, loading, error } = useProducts(
 *   selectedCategoryId,
 *   [0, 1000],
 *   "cake",
 *   pagination,
 *   setPagination
 * );
 */
export default function useProducts(
    selectedCategoryId,
    priceRange,
    searchInput,
    pagination,
    setPagination
) {
    const [products, setProducts] = useState([]);
    const justFirstImage = true;

    const debouncedGetProducts = useMemo(
        () =>
            debounce(
                (categoryIds, min, max, search, page, firstImage) =>
                    getProducts(categoryIds, min, max, search, page, firstImage),
                2000
            ),
        []
    );

    const handleFetchProducts = useCallback(
        (result) => {
            const res = result.data;
            setProducts(res.data);
            if (setPagination) {
                setPagination((prev) => ({
                    ...prev,
                    current_page: res.current_page,
                    last_page: res.last_page,
                    next_page_url: res.next_page_url,
                    prev_page_url: res.prev_page_url,
                    total_items: res.total,
                }));
            }
        },
        [setPagination]
    );

    const { data, loading, error } = useFetch(
        debouncedGetProducts,
        handleFetchProducts,
        selectedCategoryId,
        priceRange[0],
        priceRange[1],
        searchInput,
        pagination.current_page,
        justFirstImage
    );

    return { products, data, loading, error };
}

