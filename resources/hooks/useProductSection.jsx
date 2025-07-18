import { useState, useCallback, useEffect } from 'react';
import getCategories from '../js/Services/category.service';
import { getProductsByCategories } from '../js/Services/product.service';

export default function useProductSection() {
  const [categories, setCategories] = useState([]);
  const [selectedCategoryId, setSelectedCategoryId] = useState([]);
  const [products, setProducts] = useState([]);
  const [pagination, setPagination] = useState({
    current_page: 1,
    last_page: 1,
    next_page_url: null,
    prev_page_url: null
  });

  const updateCategorySelection = useCallback((selectedId, isChecked) => {
    setSelectedCategoryId(prev =>
      isChecked
        ? [...prev, selectedId]
        : prev.filter(prevId => prevId !== selectedId)
    );
  }, []);

  const onPageChange = useCallback((pageNumber) => {
    setPagination(prev => ({
      ...prev,
      current_page: pageNumber
    }));
  }, []);

  useEffect(() => {
    let isMounted = true;

    (async () => {
        const fetchedCategories = await getCategories();
        if (!isMounted) return;
        
        setCategories(fetchedCategories.data);

        setSelectedCategoryId(prev =>
            prev.length === 0 ? fetchedCategories.data.map((c) => c.id) : prev
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
      const fetchedProducts = await getProductsByCategories(
        selectedCategoryId,
        pagination.current_page,
        justFirstImage
      );

      if (!isMounted) return;

      setProducts(fetchedProducts.data.data);

      setPagination(prev => ({
        ...prev,
        total_items: fetchedProducts.data.total,
        current_page: fetchedProducts.data.current_page,
        last_page: fetchedProducts.data.last_page,
        next_page_url: fetchedProducts.data.next_page_url,
        prev_page_url: fetchedProducts.data.prev_page_url
      }));
    })();

    return () => {
      isMounted = false;
    };
  }, [selectedCategoryId, pagination.current_page]);

  return {
    categories,
    selectedCategoryId,
    updateCategorySelection,
    products,
    pagination,
    onPageChange
  };
}/**

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