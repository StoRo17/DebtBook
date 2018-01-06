import api from '../../api/debtbook';
import * as types from '../mutation-types';


const state = {
    loading: false,
    debtHistory: []
}

const getters = {
    debtHistory(state) {
        return state.debtHistory;
    }
}

const mutations = {
    [types.SET_LOADING](state, bool) {
        state.loading = bool;
    },

    [types.SET_DEBT_HISTORY](state, data) {
        state.debtHistory = data;
    }
}

const actions = {
    loadDebtHistory({ commit }, debtId) {
        commit(types.SET_LOADING, true);
        api.getDebtHistory(debtId)
            .then(response => {
                commit(types.SET_DEBT_HISTORY, response.data);
                commit(types.SET_LOADING, false);
            })
            .catch(error => {
                console.log(error);
                commit(types.ERROR);
                commit(types.SET_LOADING, false);
            });
    }, 

    createDebtHistory({ commit }, payload) {
        return new Promise((resolve, reject) => {
            api.createDebtHistory(payload.debtId, payload.data)
                .then(response => {
                    commit(types.UPDATE_DEBTS);
                    resolve();
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