import Vuex from 'vuex';
import * as types from './mutation-types';
import auth from './modules/auth';
import user from './modules/user';
import profile from  './modules/profile';
import debts from './modules/debts';
import currencies from './modules/currencies';


export default new Vuex.Store({
    state: {
        loading: false,
        error: false,
        debtsHistories: {}
    },

    mutations: {
        [types.LOADING_START](state) {
            state.loading = true;
        },

        [types.LOADING_STOP](state) {
            state.loading = false;
        },

        [types.ERROR](state) {
            state.error = true;
        },

        addDebtHistory(state, payload) {
            state.debtsHistories[payload.debtId] = payload.debtHistory;
        }
    },

    getters: {
        loading(state) {
            return state.loading;
        },

        error(state) {
            return state.error;
        }
    },

    modules: {
        auth,
        user,
        profile,
        debts,
        currencies
    }
});