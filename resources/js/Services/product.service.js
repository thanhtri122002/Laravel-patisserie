import axios from "axios";
import api from "./api/axios";
import getCategories from "./category.service";

const getProductsByCategories = async (categoryIds = [], page = 1) => {
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
        response.data.data.data.map((product) =>( {
            ...product,
            firstImage: product.productImages?.[0] || null,
        }))
        return response.data;
            
        
    } catch (error) {
        console.log('Error occured', error);
        return [];
    }
}


export {getProductsByCategories};