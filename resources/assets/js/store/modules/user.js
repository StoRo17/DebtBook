import api from '../../api/debtbook';
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
    loadUser({ commit }, userId) {
        commit(types.LOADING_START);
        api.getUser(userId)
            .then(response => {
                commit(types.SET_USER, response.data);
                commit(types.LOADING_STOP);
            })
            .catch(error => {
                console.log(error);
                commit(types.ERROR);
                commit(types.LOADING_STOP);
            });
    },

    changePassword({ commit }, payload) {
        return new Promise((resolve, reject) => {
            api.changePassword(payload.userId, payload.data)
                .then(response => {
                    resolve(response);
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