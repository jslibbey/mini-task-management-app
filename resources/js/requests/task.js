import api from "@api";

export const getTasks = async () => {
    try {
        return await api.get(`/api/tasks`);
    } catch (error) {
        console.log(error);
    }
};

export const showTask = async (id) => {
    return await api.get(`/api/tasks/${id}`);
};

export const storeTask = async (values) => {
    return await api.post(`/api/tasks`, values);
};

export const updateTask = async (id, values) => {
    return await api.put(`/api/tasks/${id}`, values);
};

export const deleteTask = async (id) => {
    return await api.delete(`/api/tasks/${id}`);
};
