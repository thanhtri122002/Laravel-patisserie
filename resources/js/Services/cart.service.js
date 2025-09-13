import api from "./api/axios";
import { handleApiError } from "../utils/helpers";
import { Navigate } from "react-router-dom";

export const addProductToCart = async (
    productId,
    quantity = 1,
    productImage
) => {
    try {
        const params = {
            product_id: productId,
            quantity: quantity,
        };

        const response = await api.post("/user/cart", params);

        response.data = {
            ...response.data,
            image: productImage,
        };

        return response.data;
    } catch (error) {
        return handleApiError(error);
    }
};

export const removeProductFromCart = async (productDetailId) => {
    try {
        const response = await api.post(`/user/cart/${productDetailId}/delete`);

        return response.data;
    } catch (error) {
        console.error(
            "Occured an error in the removing product from cart function",
            error
        );
    }
};

export const updateProductQuantity = async (
    productDetailId,
    quantity,
    mode
) => {
    try {
        const params = {
            id: productDetailId,
            quantity: quantity,
            mode: mode,
        };

        const response = await api.post(
            `/user/cart/${productDetailId}`,
            params
        );

        return response.data;
    } catch (error) {
        console.error(
            "Occured an error in the updating product's quantity function",
            error
        );
    }
};

export const getCart = async () => {
    try {
        const response = await api.get("/user/cart");

        return response.data;
    } catch (error) {
        console.error("Occured an error in the getCart function", error);
    }
};

export const createInvoice = async () => {
    try {
        const response = await api.post("/user/cart/submit");
        
        const { id , order_code, user } = response.data.data;
        
        return { id, order_code, user };
    } catch (error) {
        console.error("Occured an error in submitCart function", error);
    }
};

/**
 * CreateInvoice response.data: 
 * Object { data: {…}, message: "Submit successfully", status: 200, error: null }
​
data: Object { cost: 174381, user_id: 1, order_code: "INV-20250908-WYBSR", … }
​​
cost: 174381
​​
created_at: "2025-09-08T08:29:05.000000Z"
​​
email: "thanhnt122002@gmail.com"
​​
id: 237
​​
order_code: "INV-20250908-WYBSR"
​​
updated_at: "2025-09-08T08:29:05.000000Z"
​​
user: Object { id: 1, name: "Thanh", email: "thanhnt122002@gmail.com", … }
​​​
created_at: "2025-03-03T09:02:48.000000Z"
​​​
email: "thanhnt122002@gmail.com"
​​​
email_verified_at: null
​​​
id: 1
​​​
name: "Thanh"
​​​
pm_last_four: null
​​​
pm_type: null
​​​
stripe_id: null
​​​
updated_at: "2025-03-03T09:02:48.000000Z"
​​​
<prototype>: Object { … }
​​
user_id: 1
​​
<prototype>: Object { … }
​
error: null
​
message: "Submit successfully"
​
status: 200
 */
