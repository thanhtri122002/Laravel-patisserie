import api from './api/axios';

export const addProductToCart = async (productId, quantity = 1, productImage) => {
    try {
        const params = {
            product_id: productId,
            quantity: quantity,
        };
        
        const response = await api.post("user/cart", params);
        response.data = {
            ...response.data,
            image: productImage
        };

        console.log('we are done calling the add product api');
        return response.data;

    } catch (error) {
        console.error('Occcured an error in the adding product function', error);
    }
}

export const removeProductFromCart = async (productDetailId) => {
    try {

        const response = await api.post(`user/cart/${productDetailId}/delete`)
        
        return response.data;

    } catch (error) {

        console.error('Occured an error in the removing product from cart function', error);
    }
}

export const updateProductQuantity = async (productDetailId, quantity, mode) => {
    try {
        const params = {
            id: productDetailId,
            quantity: quantity,
            mode: mode
        }
      
        const response = await api.post(`user/cart/${productDetailId}`, params);

        return response.data;

    } catch (error) {
        
        console.error("Occured an error in the updating product's quantity function", error);
    }
}


export const getCart = async () => {
    try {
    
        const response = await api.get('user/cart');

        console.log(response.data);
        return response.data; 

    } catch (error) {
        console.error('Occured an error in the getCart function', error);
    }
}

export const createInvoice = async () => {
    try {

        const response = await api.post('user/cart/submit');

        return response.data;
    } catch (error) {
        console.error('Occured an error in submitCart function', error);
    }
}
