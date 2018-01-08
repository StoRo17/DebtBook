import api from '../../api/debtbook';
import * as types from '../mutation-types';


const state = {
    updated: false,
    profile: {}
}

const getters = {
    profile(state) {
        return state.profile;
    },
    
    profileUpdated(state) {
        return state.updated;
    }
}

const mutations = {
    [types.SET_PROFILE](state, profile) {
        state.profile = profile;
    },

    [types.UPDATE_PROFILE](state) {
        state.updated = false;
    },

    [types.PROFILE_UPDATED](state) {
        state.updated = true
    }
}

const actions = {
    loadProfile({ state, commit }, userId) {
        if (!state.updated) {
            commit(types.LOADING_START);
            api.getProfile(userId)
                .then(response => {
                    commit(types.SET_PROFILE, response.data);
                    commit(types.PROFILE_UPDATED);
                    commit(types.LOADING_STOP);
                })
                .catch(error => {
                    console.log(error);
                    commit(types.ERROR);
                    commit(types.LOADING_STOP);
                });
        }
    },

    updateProfile({ commit }, payload) {
        return new Promise((resolve, reject) => { 
            api.editProfile(payload.userId, payload.data)
                .then(response => {
                    commit(types.UPDATE_PROFILE);
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}
