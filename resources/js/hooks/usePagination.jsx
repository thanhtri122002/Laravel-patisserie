import { useState, useCallback } from "react";

/**
 * A custom hook that define and support some pagination operation
 * @param {int} initialPage 
 * @returns {object} that contain pagination state data + its setter, the page changing and reseting the pagination fuynction
 *  @property {object} pagination - pagination data
 *  @property {function} setPagination -
 *  @property {function} OnPageChange - a function to change the page
 *  @property {function} resetPagination - a function to reset the pagination to the first page, usualy used when filtering happens
 */
export default function usePagination(initialPage = 1) {
    const [pagination, setPagination] = useState({
        
        current_page: initialPage,
        last_page: 1,
        next_page_url: null,
        prev_page_url: null,
        total_items: 0,
    });

    const onPageChange = useCallback((pageNumber) => {
        setPagination((prev) => ({
            ...prev,
            current_page: pageNumber,
        }));
    }, []);

    const resetPagination = useCallback(() => {
        setPagination((prev) => ({ ...prev, current_page: 1 }));
    }, []);

    return { pagination, setPagination, onPageChange, resetPagination };
}
