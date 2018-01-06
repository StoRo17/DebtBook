import api from '../../api/debtbook';
import * as types from '../mutation-types';


const state = {

}

const getters = {

}

const mutations = {

}

const actions = {
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