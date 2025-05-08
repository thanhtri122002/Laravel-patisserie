import axios from "axios";

const api = axios.create({
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

export default api;