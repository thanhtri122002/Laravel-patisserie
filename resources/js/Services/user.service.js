<<<<<<< HEAD
=======
import axios from "axios";
>>>>>>> master
import api from "./api/axios";
import { makeQueryString, handleApiError } from "../utils/helpers";

const getUsers = async (role) => {
    try {
        const params = {
            role: role,
        };
<<<<<<< HEAD
        
        const response = await api.get("/api/public/user/index", params);
=======

        const response = await api.get("/user", params);
>>>>>>> master

        return response.data.data;
    } catch (err) {
        return handleApiError(err);
    }
};

<<<<<<< HEAD
const getCountUser = async () => {
    try {
        const response = await api.get("/api/public/user/count");
        
        return response.data;
    } catch (err) {
        return handleApiError(err);
    }
}

export { getUsers, getCountUser };
=======
export { getUsers };
>>>>>>> master
