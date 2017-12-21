import axios from 'axios';


const PREFIX = '/api';

export default {
    login(data) {
        return post(PREFIX + '/login', data);
    },

    register(data) {
        return post(PREFIX + '/register', data);
    }
}

function post(url, data) {
    return request('post', url, data);
}

function put(url, data) {
    return request('put', url, data);
}

function patch(url, data) {
    return request('patch', url, data);
}

function del(url, data) {
    return request('delete', url, data);
}

function request(requestType, url, data = []) {
    return new Promise((resolve, reject) => {
        axios[requestType](url, data)
            .then(response => {
                resolve(response.data);
            })
            .catch(error => {
                reject(error.response.data);
            });
    })
}


