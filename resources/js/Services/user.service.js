import axios from "axios";
import api from "./api/axios";
import { makeQueryString, handleApiError } from "../utils/helpers";

const getUsers = async (role) => {
    try {
        const params = {
            role: role,
        };

        const response = await api.get("/user", params);

        return response.data.data;
    } catch (err) {
        return handleApiError(err);
    }
};

export { getUsers };
