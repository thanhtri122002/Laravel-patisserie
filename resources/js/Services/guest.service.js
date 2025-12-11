import api from "./api/axios";
import { makeQueryString, handleApiError } from "../utils/helpers";

export const sendContact = async (formData) => {
    try {
        const params = {
            first_name: formData.firstName,
            last_name: formData.lastName,
            email: formData.eMail,
            message: formData.message
        }
        console.log(params);
        const response = await api.post('/api/public/sendContact', params );
        
        return response.data;
    } catch (err) {
        return err.response;
    }
}