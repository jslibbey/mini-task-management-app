
import api from '@api';

export const login = async (values) => {
    try {
        const tokenResult = await api.get('/sanctum/csrf-cookie')
        const loginResult = await api.post(`/api/login`, values)

        return loginResult
    } catch (error) {
        console.log(error);
    }
}
