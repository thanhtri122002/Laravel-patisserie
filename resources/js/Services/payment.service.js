import api from "./api/axios";

export const createSession = async (invoiceId) => {
    const response = await api.post(
        `/user/checkoutSession/createSession/${invoiceId}`
    );

    return response.data.clientSecret;
};

// export const afterPayment = async (paymentStatus, ) => {
//     if (paymentStatus !== "paid") {
//         console.log('unpaid'); return
//     }
//     else {
//         const response =
//     }

// }
