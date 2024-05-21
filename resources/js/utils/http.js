import axios from "axios";
// import store from "@store";

const serverUrl = import.meta.env.VITE_SERVER_URL || import.meta.env.APP_URL

const API = axios.create({
    baseURL: serverUrl || 'http://localhost:8000',
    withCredentials: true,
    headers: {
        'Accept': 'application/json'
    }
});


const routesWithoutLoader = [
    '/api/v1/notifications'
]


API.interceptors.request.use((request) => {
    if (!request.url.includes(routesWithoutLoader)) {
        // store.commit("isLoading", true);
    }
    return request;
});

API.interceptors.response.use(
    (response) => {
        // store.commit("isLoading", false);
        return Promise.resolve(response);
    },
    (error) => {
        const { config, response } = error;
        const originalRequest = config;
        // store.commit('isLoading', false);
        return Promise.reject(error);
    }
);
export default API;
