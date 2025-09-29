import { handleApiError } from "../utils/helpers"
import api from "./api/axios";

export const getInvoice = async (id) => {
    try {
        const response = await api.get(`/user/invoices/${id}`);
        
        return {data: response.data, errors: null }
    } catch (err) {
        handleApiError(err);
    }
}

export const 