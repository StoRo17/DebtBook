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
    setProfile({ commit }, profile) {
        commit(types.SET_PROFILE, profile);
    }
}

export default {
    state,
    mutations,
    actions
}
