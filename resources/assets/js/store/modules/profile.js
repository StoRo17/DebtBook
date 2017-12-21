import * as types from '../mutation-types';


const state = {
    profile: {}
}

const mutations = {
    [types.SET_PROFILE](state, profile) {
        state.profile = profile;
    }
}

const actions = {
    getProfile({ commit }, profile) {
        commit(types.SET_PROFILE);
    }
}

export default {
    state,
    mutations,
    actions
}
