import { handleApiError } from "../utils/helpers";
import api from "./api/axios";

export const getInvoice = async (id) => {
    try {
        const response = await api.get(`/user/invoices/${id}`);

        return { data: response.data, errors: null };
    } catch (err) {
        handleApiError(err);
    }
};
<<<<<<< HEAD

export const getCountInvoiceWithStatus = async (status) => {
    try {
        const params = {
            status: status
        };
        console.log(params);
        const response = await api.get('/api/public/invoices/count', { params });
        
        return response.data;
    } catch (err) {
        console.log('error ahppend', err);
        return handleApiError(err);
    }
}

// export const getInvoiceWithStatus = async (status) => {
//     try {
//         const params = {
//             status: status,
//         };
//         console.log(params);
//         const response = await api.get("/api/public/invoices/index", {params});
        
//         return response.data.data;
//     } catch (err) {
//         return handleApiError(err);
//     }
// };


=======

export const getInvoiceWithStatus = async (status) => {
    try {
        const params = {
            status: status,
        };
        const response = await api.get("/invoices/index", params);
        
        return response.data.data;
    } catch (err) {
        return handleApiError(err);
    }
};
>>>>>>> master
