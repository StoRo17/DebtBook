import * as types from '../mutation-types';


const state = {
    user: {}
}

const getters = {
    user(state) {
        return state.user;
    }
}

const mutations = {
    [types.SET_USER](state, user) {
        state.user = user;
    }
}

const actions = {
    setUser({ commit }, user) {
        commit(types.SET_USER, user);
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}