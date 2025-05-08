import axios from 'axios';
import api from './api/axios';



const getCategories = async () => {
    try {
        const response = await api.get('/api/public/categories', {

        });
        return response.data;
    } catch(error) {
        console.log('Failed to fetch the products:', error);
        return [];
    }
}


export default getCategories;