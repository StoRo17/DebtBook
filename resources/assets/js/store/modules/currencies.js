import api from '../../api/debtbook';
import * as types from '../mutation-types'

const state = {
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
    } 
}

const actions = {
    loadCurrencies({ commit }) {
        api.getCurrencies()
            .then(response => {
                commit(types.SET_CURRENCIES, response.data);
            })
            .catch(error => {
                console.log(error);
                commit(types.ERROR);
            });
    } 
}

export default {
    state,
    getters,
    mutations,
    actions
}