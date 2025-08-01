import api from '../api/axios.js';

const login = async (formData = {}) => {
    try {
        
        const response = await api.post("user/login", formData);

        return { data: response.data, error: null };

    } catch (err) {
        if (err.response) {
            return { data: null, error: err.response.data.errors};
        }
        
        return { data: null, error: { general: ['Something went wrong.'] } }
        
    }
}

const register = async (formData = {}) => {
    try {
        
        const response = await api.post("user/register", formData);

        return { data: response.data, error: null }
    } catch (err) {
        if (err.response) {

            return { data: null, error: err.response.data.errors };

        } else {
            
            return { data: null, error: { general: ['Something went wrong'] } };
        }
    }
}

const forgotPassword = async (email) => {
    try {
        
        const response = await api.post('user/forgot-password', email);

        return { data: response, errors: null };
    } catch (err) {
        if (err.response) {

            return { data: null, errors: err.response.data.errors };
        } else {
            return { data: null, error: { general: ['Something went wrong'] } };
        }
    }
}

export { login, register, forgotPassword } ;