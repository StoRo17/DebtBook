import api from '../../api/debtbook';
import * as types from '../mutation-types';


const state = {
    debts: [],
    loading: false,
    loaded: false,
}

const getters = {
    debts(state) {
        return state.debts;
    },

    loaded(state) {
        return state.loaded;
    }
}

const mutations = {
    [types.SET_DEBTS](state, debts) {
        state.debts = debts;
    },

    [types.SET_LOADING](state, bool) {
        state.loading = bool
    },

    [types.DEBTS_LOADED](state) {
        state.loaded = true;
    },

    [types.UPDATE_DEBTS](state) {
        state.loaded = false;
    }
}

const actions = {
    loadDebts({ state, commit }, userId) {
        if (!state.loaded) {
            commit(types.SET_LOADING, true);
            api.getDebts(userId)
                .then(response => {
                    commit(types.SET_DEBTS, response.data);
                    commit(types.DEBTS_LOADED);
                    commit(types.SET_LOADING, false);
                })
                .catch(error => {
                    console.log(error);
                    commit(types.ERROR);
                    commit(types.SET_LOADING, false);
                });
        }
    },

    loadDebt({ commit }, debtId) {
        return new Promise((resolve, reject) => {
            api.getDebt(debtId)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error);
                });
        })        
    },

    createDebt({ commit }, data) {
        return new Promise((resolve, reject) => {
            api.createDebt(data)
                .then(response => {
                    commit(types.UPDATE_DEBTS);
                    resolve();
                })
                .catch(error => {
                    reject(error);
                })
        })
    },

    deleteDebt({ commit }, debtId) {
        return new Promise((resolve, reject) => {
            api.deleteDebt(debtId)
            .then(response => {
                commit(types.UPDATE_DEBTS);
                resolve();
            })
            .catch(error => {
                console.log(error);
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
