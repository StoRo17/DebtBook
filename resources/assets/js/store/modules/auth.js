import api from '../../api/debtbook';
import * as types from '../mutation-types';

const state = {
    isLoggedIn: !!localStorage['access_token'],
    userId: localStorage['user_id'],
    accessToken: localStorage['access_token'],
    expiresIn: localStorage['expires_in']
}

const getters = {
    isLoggedIn (state) {
        return state.isLoggedIn;
    },

    accessToken (state) {
        return state.accessToken;
    },

    userId(state) {
        return state.userId;
    }
}

const mutations = {
    [types.SET_TOKEN](state, data) {
        state.accessToken = data.access_token;
        state.expiresIn = data.expires_in;
    },

    [types.SET_USER_ID](state, id) {
        state.userId = id;
    },

    [types.LOGIN](state) {
        state.isLoggedIn = true;
    },

    [types.LOGOUT](state) {
        state.isLoggedIn = false;
        state.userId = null;
        state.accessToken = '';
        state.expiresIn = null;
    }
}

const actions = {
    login({ commit }, data) {
        return new Promise((resolve, reject) => {
            api.login(data)
                .then(response => {
                    localStorage['user_id'] = response.user_id;
                    localStorage['access_token'] = response.tokens.access_token;
                    localStorage['expires_in'] = response.tokens.expires_in;       
                    commit(types.SET_TOKEN, response.tokens);
                    commit(types.SET_USER_ID, response.user_id);
                    commit(types.LOGIN);
                    resolve();
                })
                .catch(error => {
                    reject(error);
                });
        }) 
    },

    logout({ commit }) {
        delete localStorage['user_id'];
        delete localStorage['access_token'];
        delete localStorage['expires_in'];
        commit(types.LOGOUT);
    }
}

export default {
    state,
    getters, 
    mutations,
    actions
}
