import * as types from '../mutation-types';

const state = {
    isLoggedIn: !!localStorage['access_token'],
    accessToken: localStorage['access_token'],
    expiresIn: localStorage['expires_in']
}

const getters = {
    isLoggedIn (state) {
        return state.isLoggedIn;
    },

    accessToken (state) {
        return state.accessToken;
    }
}

const mutations = {
    [types.SET_TOKEN](state, data) {
        state.accessToken = data.access_token;
        state.expiresIn = data.expires_in;
    },

    [types.LOGIN](state) {
        state.isLoggedIn = true;
    },

    [types.LOGOUT](state) {
        state.isLoggedIn = false;
        state.accessToken = '';
        state.expiresIn = null;
    }
}

const actions = {
    login({ commit }, tokenData) {
        localStorage['access_token'] = tokenData.access_token;
        localStorage['expires_in'] = tokenData.expires_in;
        commit(types.SET_TOKEN, tokenData);
        commit(types.LOGIN);
    },

    logout({ commit }) {
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
