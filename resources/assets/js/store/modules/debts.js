import * as types from '../mutation-types';


const state = {
    debts: []
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

    [types.ADD_DEBT](state, debt) {
        state.debts.push(debt);
    }
}

const actions = {
    setDebts({ commit }, debts) {
        commit(types.SET_DEBTS, debts);
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
