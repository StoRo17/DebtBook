import Vuex from 'vuex';
import * as types from './mutation-types';
import auth from './modules/auth';
import user from './modules/user';
import profile from  './modules/profile';
import debts from './modules/debts';


export default new Vuex.Store({
    state: {
        loading: false,
        error: false,
        debtsHistories: {},
        currencies: []
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

        setCurrencies(state, currencies) {
            state.currencies = currencies;
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
        },

        currencies(state) {
            return state.currencies;
        }
    },

    modules: {
        auth,
        user,
        profile,
        debts
    }
});