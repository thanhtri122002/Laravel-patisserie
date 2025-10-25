// useCategories.js
import { useState, useEffect, useCallback } from "react";
import getCategories from "../Services/category.service";
import useFetch from "./useFetch";

/**
 * Custom react hook - 'useCategories'
 * 
 * A hook that manages category data and user-selected categories
 * It fetches all categories from the backend, sets the initial selection and provides convenient methods to update selected categories
 * 
 * ## Features: 
 * - Fetch category data from a getCategories
 * - Automatically selects all categories on the first load
 * - Allows update of selected category 
 * - Return loading and error states for async operation
 * 
 * ## Dependencies: 
 * - useFetch: custom hook used for fetching data
 * - getCategories: service function that fetches category data
 * 
 * 
 * @returns {Object} Object containing category data, selection state, and handlers.
 */
export default function useCategories() {
    const [selectedCategoryId, setSelectedCategoryId] = useState([]);

    const handleSetInitialCategories = useCallback((result) => {
        if (!result?.data) return;
        setSelectedCategoryId((prev) =>
            prev.length === 0 ? result.data.map((c) => c.id) : prev
        );
    }, []);

    const { data, loading, error } = useFetch(getCategories, handleSetInitialCategories);
    
    const handleUpdateSelectedCategory = useCallback(
        (selectedId, isChecked) => {
            setSelectedCategoryId((prev) =>
                isChecked ? [...prev, selectedId] : prev.filter((id) => id !== selectedId)
            );
        },
        []
    );

    return {
        categories: data || [],
        selectedCategoryId,
        handleUpdateSelectedCategory,
        loading,
        error,
    };
}

