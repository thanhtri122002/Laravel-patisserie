import axios from "axios";
import api from "./api/axios";
import getCategories from "./category.service";

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
 * @throws {Error} Logs an error message to the console if the request fails.
 */

const getProductsByCategories = async (categoryIds = [], page = 1, justFirstImage = false) => {
    try {
        
        const params = {
            category_id: categoryIds,
            page: page,
        };

        const queryString = Object.entries(params)
            
            .map(([key, value]) => Array.isArray(value) 
                ? value.map((v) => `${key}[]=${encodeURIComponent(v)}`).join('&')
                : `${key}=${encodeURIComponent(value)}`
            ).join('&');

        const url = `/api/public/products?${queryString}`;
        console.log('url', url)
        const response = await axios.get(url);
        console.log('response', response.data);
        if (justFirstImage) {
            response.data.data.data.map((product) =>( {
                ...product,
                firstImage: product.productImages?.[0] || null,
            }))
        }
        
        return response.data;
            
    } catch (error) {
        console.log('Error occured', error);
        return [];
    }
}


export {getProductsByCategories};