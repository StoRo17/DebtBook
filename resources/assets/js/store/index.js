import Vuex from 'vuex';
import auth from './modules/auth';
import user from './modules/user';
import profile from  './modules/profile';
import debts from './modules/debts';


export default new Vuex.Store({
    state: {
        debtsHistories: {},
        currencies: []
    },

    mutations: {
        setCurrencies(state, currencies) {
            state.currencies = currencies;
        },

        addDebtHistory(state, payload) {
            state.debtsHistories[payload.debtId] = payload.debtHistory;
        }
    },

    getters: {
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