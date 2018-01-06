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
    },

    [types.ADD_DEBT](state, debt) {
        state.debts.push(debt);
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

    addDebt({ commit }, debt) {
        commit(types.ADD_DEBT, debt);
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}
