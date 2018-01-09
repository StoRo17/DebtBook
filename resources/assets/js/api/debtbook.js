import axios from 'axios';


const PREFIX = '/api';
const USERS_PATH = PREFIX + '/users/';
const DEBTS_PATH = '/debts/';
const DEBTS_HISTORY_PATH = '/history/';

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

    changePassword(userId, data) {
        return put(USERS_PATH + userId + '/change-password', data);
    },

    getProfile(userId) {
        return get(USERS_PATH + userId + '/profile');
    },

    editProfile(userId, data) {
        return put(USERS_PATH + userId + '/profile', data);
    },

    getDebts(userId) {
        return get(USERS_PATH + userId + DEBTS_PATH);
    },

    getDebt(debtId) {
        return get(PREFIX + DEBTS_PATH + debtId);
    },

    getDebtHistory(debtId) {
        return get(PREFIX + DEBTS_PATH + debtId + DEBTS_HISTORY_PATH);
    },

    getDebtHistoryElement(debtId, debtHistoryElementId) {
        return get(PREFIX + DEBTS_PATH + debtId + DEBTS_HISTORY_PATH + debtHistoryElementId);
    },

    updateDebtHistoryElement(debtId, debtHistoryElementId, data) {
        return put(PREFIX + DEBTS_PATH + debtId + DEBTS_HISTORY_PATH + debtHistoryElementId, data);        
    },

    createDebt(data) {
        return post(PREFIX + DEBTS_PATH, data);
    },

    createDebtHistory(debtId, data) {
        return post(PREFIX + DEBTS_PATH + debtId + DEBTS_HISTORY_PATH, data);
    },

    deleteDebt(debtId) {
        return del(PREFIX + DEBTS_PATH + debtId);
    },

    deleteDebtHistory(debtId, debtHistoryId) {
        return del(PREFIX + DEBTS_PATH + debtId + DEBTS_HISTORY_PATH + debtHistoryId);
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


