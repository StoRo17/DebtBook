import api from '../../api/debtbook';
import * as types from '../mutation-types';


const state = {
    profile: {}
}

const getters = {
    profile(state) {
        return state.profile;
    } 
}

const mutations = {
    [types.SET_PROFILE](state, profile) {
        state.profile = profile;
    }
}

const actions = {
    loadProfile({ commit }, userId) {
        commit(types.LOADING_START);
        api.getProfile(userId)
            .then(response => {
                commit(types.SET_PROFILE, response.data);
                commit(types.LOADING_STOP);
            })
            .catch(error => {
                console.log(error);
                commit(types.ERROR);
                commit(types.LOADING_STOP);
            });
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}
