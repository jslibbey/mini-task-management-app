import API from './http';

const checkUrl = (url) => {
    const putMethod = url.includes('?') ? '&' : '?'
    const finallUrl = url + `${putMethod}_method=PUT`
    return finallUrl
}

export default {
    logout: () => new Promise(async (resolve, reject) => {
        try {
            const { data } = await API.post('/logout')
            resolve(data)
        } catch (error) {
            reject(error)
        }
    }),

    get: (url, params = {}) => new Promise(async (resolve, reject) => {
        try {
            const { data } = await API.get(url, { params: params })
            resolve(data)
        } catch (error) {
            reject(error)
        }
    }),

    post: (url, requestData = {}) => new Promise(async (resolve, reject) => {
        try {
            const { data } = await API.post(url, requestData)
            resolve(data)
        } catch (error) {
            reject(error)
        }
    }),

    put: (url, requestData = {}) => new Promise(async (resolve, reject) => {
        try {
            const { data } = await API.post(checkUrl(url), requestData)
            resolve(data)
        } catch (error) {
            reject(error)
        }
    }),

    patch: (url, requestData = {}) => new Promise(async (resolve, reject) => {
        try {
            const { data } = await API.patch(url, requestData)
            resolve(data)
        } catch (error) {
            reject(error)
        }
    }),

    delete: (url, requestData = {}) => new Promise(async (resolve, reject) => {
        try {
            const { data } = await API.delete(url, requestData)
            resolve(data)
        } catch (error) {
            reject(error)
        }
    }),

}
