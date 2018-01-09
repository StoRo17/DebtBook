import Vuex from 'vuex';
import * as types from './mutation-types';
import auth from './modules/auth';
import user from './modules/user';
import profile from  './modules/profile';
import debts from './modules/debts';
import debtHistory from './modules/debtHistory';
import currencies from './modules/currencies';


export default new Vuex.Store({
    state: {
        loading: false,
        error: false,
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
        currencies,
        debtHistory
    }
});