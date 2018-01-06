import api from '../../api/debtbook';
import * as types from '../mutation-types';


const state = {
    debts: [],
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

    [types.DEBTS_LOADED](state) {
        this.loaded = true;
    },

    [types.UPDATE_DEBTS](state) {
        this.loaded = false;
    },

    [types.ADD_DEBT](state, debt) {
        state.debts.push(debt);
    }
}

const actions = {
    loadDebts({ commit }, userId) {
        api.getDebts(userId)
            .then(response => {
                commit(types.SET_DEBTS, response.data);
                commit(types.DEBTS_LOADED);
            })
            .catch(error => {
                console.log(error);
                commit(types.ERROR);
            });
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
