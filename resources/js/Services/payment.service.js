import api from "./api/axios"
import { createInvoice } from "./cart.service";

export const createSession = async (invoiceId) => {
    console.log(invoiceId);
    const response = await api.post(`user/checkoutSession/createSession/${invoiceId}`);

    return response.data.clientSecret;  
}