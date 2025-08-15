import axios from "axios";
import api from "./api/axios";

/**
 * Fetches products by categories with optional pagination and image filtering.
 *
 * @async
 * @function getProductsByCategories
 * @param {Array<number>} [categoryIds=[]] - An array of category IDs to filter products by.
 * @param {number} [page=1] - The page number for pagination.
 * @param {boolean} [justFirstImage=false] - If true, includes only the first image of each product.
 * @returns {Promise<Object|Array>} A promise that resolves to the response data containing the products,
 *                                  or an empty array if an error occurs.
 */
const getProductsByCategories = async (categoryIds = [], page = 1, justFirstImage = false) => {
    try {
        const params = {
            category_id: categoryIds,
            page: page,
        };

        const queryString = Object.entries(params)
            .map( ( [key, value] ) =>
                Array.isArray(value)
                    ? value.map((v) => `${key}[]=${encodeURIComponent(v)}`).join("&")
                    
                    : `${key}=${encodeURIComponent(value)}`
            )
            .join("&");

        const url = `/api/public/products?${queryString}`;
        const response = await axios.get(url);

        if (justFirstImage && response.data?.data?.data) {
            response.data.data.data = response.data.data.data.map((product) => ({
                ...product,
                firstImage: product.productImages?.[0] || null,
            }));
        }

        return response.data;
    } catch (err) {
        return handleApiError(err);
    }
};

/**
 * 
 * @param {number} priceLimit - Maximum product price to filter by
 * @param {'asc'|'desc'} order - Sort order for results 
 * @returns {Promise<{ data: Object|null, errors: Object|null}>} A promise resolving to the data
 * @throws {Error} if the network request fails or the server returns an error
 */
const getProductsInPriceRange = async (priceLimit, order) => {
    try {
        const response = await api.get("products/filter/price-range", {
            params: { priceLimit, order },
        });
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};
/**
 * Return the new products
 * @param {number} limit 
 * @returns {Promise<{ data: Object|null, errors: Object|null }>}
 */
const getNewProducts = async (limit = 3) => {
    try {
        const response = await api.get(`products/filter/new/${limit}`);
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};

const getTopSellingProducts = async (limit) => {
    try {
        const response = await api.get(`products/filter/top-selling/${limit}`);
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};

const searchProducts = async (inputString) => {
    try {
        const response = await api.get(`products/filter/search/${encodeURIComponent(inputString)}`);
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};

const getMostProfitableProducts = async (limit) => {
    try {
        const response = await api.get(`products/filter/most-profitable/${limit}`);
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};

const getCurrentMonthNewProducts = async () => {
    try {
        const response = await api.get("products/filter/current-month");
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};

const getOutOfStockProducts = async () => {
    try {
        const response = await api.get("products/filter/out-of-stock");
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};

const getDiscountProducts = async () => {
    try {
        const response = await api.get("products/filter/discount");
        return { data: response.data, errors: null };
    } catch (err) {
        return handleApiError(err);
    }
};

const handleApiError = (err) => {
    if (err.response) {
        return { data: null, errors: err.response.data?.errors || err.response.data };
    }
    return { data: null, errors: { general: ["Something went wrong"] } };
};

export {
    getProductsByCategories,
    getProductsInPriceRange,
    getNewProducts,
    getTopSellingProducts,
    searchProducts,
    getMostProfitableProducts,
    getCurrentMonthNewProducts,
    getOutOfStockProducts,
    getDiscountProducts,
};
