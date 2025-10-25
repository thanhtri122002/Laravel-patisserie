import api from "./api/axios";
import { makeQueryString, handleApiError } from "../utils/helpers";

const getUsers = async (role) => {
    try {
        const params = {
            role: role,
        };
        
        const response = await api.get("/api/public/user/index", params);

        return response.data.data;
    } catch (err) {
        return handleApiError(err);
    }
};

const getCountUser = async () => {
    try {
        const response = await api.get("/api/public/user/count");
        
        return response.data;
    } catch (err) {
        return handleApiError(err);
    }
}

export { getUsers, getCountUser };
