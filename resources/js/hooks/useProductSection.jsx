import { useState, useCallback, useEffect, useMemo } from "react";
import getCategories from "../Services/category.service";
import { debounce } from "../utils/helpers";
import { getProducts } from "../Services/product.service";

export default function useProductSection() {
    const [categories, setCategories] = useState([]);
    const [selectedCategoryId, setSelectedCategoryId] = useState([]);
    const [products, setProducts] = useState([]);
    const [searchInput, setSearchInput] = useState("");
    const [priceRange, setPriceRange] = useState([0.0, 1000000.0]);
    const [pagination, setPagination] = useState({
        current_page: 1,
        last_page: 1,
        next_page_url: null,
        prev_page_url: null,
    });

    const updateSelectedCategory = useCallback((selectedId, isChecked) => {
        setSelectedCategoryId((prev) =>
            isChecked
                ? [...prev, selectedId]
                : prev.filter((prevId) => prevId !== selectedId)
        );
        setPagination((prev) => ({ ...prev, current_page: 1 }));
    }, []);

    const handleUpdateSelectedCategory = useCallback(
        (selectedId, isChecked) => {
            updateSelectedCategory(selectedId, isChecked);
        },
        [selectedCategoryId]
    );

    const updateSearchInput = useCallback((input) => {
        setSearchInput(input);
        setPagination((prev) => ({ ...prev, current_page: 1 }));
    }, []);

    const updatePriceRange = useCallback((min, max) => {
        setPriceRange([min, max]);
        setPagination((prev) => ({ ...prev, current_page: 1 }));
    }, []);

    const onPageChange = useCallback((pageNumber) => {
        setPagination((prev) => ({
            ...prev,
            current_page: pageNumber,
        }));
    }, []);

    const debouncedGetProducts = useMemo(
        () =>
            debounce(
                (
                    categoryIds,
                    minPrice,
                    maxPrice,
                    searchInput,
                    page,
                    justFirstImage
                ) =>
                    getProducts(
                        categoryIds,
                        minPrice,
                        maxPrice,
                        searchInput,
                        page,
                        justFirstImage
                    ),
                1000
            ),
        []
    );

    useEffect(() => {
        let isMounted = true;

        (async () => {
            const fetchedCategories = await getCategories();

            if (!isMounted) return;

            setCategories(fetchedCategories.data);

            setSelectedCategoryId((prev) =>
                prev.length === 0
                    ? fetchedCategories.data.map((c) => c.id)
                    : prev
            );
        })();

        return () => {
            isMounted = false;
        };
    }, []);

    useEffect(() => {
        const justFirstImage = true;
        if (selectedCategoryId.length === 0) {
            setProducts([]);
            return;
        }

        let isMounted = true;

        (async () => {
            const productsResponse = await debouncedGetProducts(
                selectedCategoryId,
                priceRange[0],
                priceRange[1],
                searchInput,
                pagination.current_page,
                justFirstImage
            );

            if (!isMounted) return;

            setProducts(productsResponse.data.data);

            setPagination((prev) => ({
                ...prev,
                total_items: productsResponse.data.total,
                current_page: productsResponse.data.current_page,
                last_page: productsResponse.data.last_page,
                next_page_url: productsResponse.data.next_page_url,
                prev_page_url: productsResponse.data.prev_page_url,
            }));
        })();

        return () => {
            isMounted = false;
        };
    }, [selectedCategoryId, pagination.current_page, priceRange, searchInput]);

    return {
        categories,
        selectedCategoryId,
        handleUpdateSelectedCategory,
        products,
        pagination,
        onPageChange,
        priceRange,
        updatePriceRange,
        searchInput,
        updateSearchInput,
    };
} /**
This is an Immediately Invoked Async Function Expression (IIAFE).

It means:

Define an async function anonymously

Immediately call it right after


(async () => {
  const data = await fetchSomething();
  console.log(data);
})();

It’s often used when you need await inside useEffect, because useEffect itself cannot be marked async

*/
