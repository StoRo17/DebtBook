import * as types from '../mutation-types';


const state = {
    user: {}
}

const mutations = {
    [types.SET_USER](state, user) {
        state.user = user;
    }
}

export default {
    state,
    mutations
}