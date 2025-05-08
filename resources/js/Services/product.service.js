import axios from "axios";
import api from "./api/axios";
import getCategories from "./category.service";

const getProductsByCategories = async (categoryIds) => {
    try {
        const products = await axios.get('/api/public/products', {
            params: {
                category_id: categoryIds
            }
        });
        return products.data;
    } catch (error) {
        console.log('Error occured', error);
        return [];
    }
}

export default getProductsByCategories;