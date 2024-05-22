
import api from '@api';
import {useToast} from "vue-toast-notification";

export const login = async (values) => {
    const toast = useToast();
    try {
        const response = await api.post(`/api/login`, values)
        return response
    } catch (error) {
        if (error.response && error.response.data.message) {
            toast.error(error.response.data.message, { position: 'top-right' });
        }
        console.log(error);
    }
}

export const register = async (values) => {
    try {
        return await api.post(`/api/register`, values)
    } catch (error) {
        console.log(error);
    }
}
