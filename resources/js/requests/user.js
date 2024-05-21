
import api from '@api';

export const getUsers = async () => {
    try {
        return await api.get(`/api/users`)
    } catch (error) {
        console.log(error);
    }
}


export const storeUser = async (values) => {
    try {
        return await api.post(`/api/users`, values)
    } catch (error) {
        console.log(error);
    }
}


export const deleteUser = async (id) => {
    try {
        return await api.delete(`/api/users/${id}`)
    } catch (error) {
        console.log(error);
    }
}
