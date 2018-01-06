import api from '../../api/debtbook';
import * as types from '../mutation-types'

const state = {
    loaded: false,
    currencies: []
}

const getters = {
    currencies(state) {
        return state.currencies;
    }
}

const mutations = {
    [types.SET_CURRENCIES](state, currencies) {
        state.currencies = currencies;
    },

    [types.CURRENCIES_LOADED](state) {
        state.loaded = true;
    }
}

const actions = {
    loadCurrencies({ state, commit }) {
        if (!state.loaded) {
            api.getCurrencies()
                .then(response => {
                    commit(types.SET_CURRENCIES, response.data);
                    commit(types.CURRENCIES_LOADED);
                })
                .catch(error => {
                    console.log(error);
                    commit(types.ERROR);
                });
        }
    } 
}

export default {
    state,
    getters,
    mutations,
    actions
}