import api from "@api";

export const getUsers = async () => {
    try {
        return await api.get(`/api/users`);
    } catch (error) {
        console.log(error);
    }
};

export const storeUser = async (values) => {
    return await api.post(`/api/users`, values);
};

export const deleteUser = async (id) => {
    return await api.delete(`/api/users/${id}`);
};
