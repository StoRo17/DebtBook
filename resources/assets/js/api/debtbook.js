import axios from 'axios';


const PREFIX = '/api';
const USERS_PATH = PREFIX + '/users/';
const DEBTS_PATH = '/debts/';

export default {
    login(data) {
        return post(PREFIX + '/login', data);
    },

    register(data) {
        return post(PREFIX + '/register', data);
    },

    getUser(userId) {
        return get(USERS_PATH + userId);
    },

    getProfile(userId) {
        return get(USERS_PATH + userId + '/profile');
    },

    createDebt(userId, data) {
        return post(USERS_PATH + userId + DEBTS_PATH, data);
    },

    getCurrencies() {
        return get(PREFIX + '/currencies');
    }
}

function get(url, data = '') {
    return request('get', url);
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


