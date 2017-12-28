import Vuex from 'vuex';
import auth from './modules/auth';
import user from './modules/user';
import profile from  './modules/profile';
import debts from './modules/debts';


export default new Vuex.Store({
    state: {
        currencies: []
    },

    mutations: {
        setCurrencies(state, currencies) {
            state.currencies = currencies;
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