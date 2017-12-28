import Vuex from 'vuex';
import auth from './modules/auth';
import user from './modules/user';
import profile from  './modules/profile';
import debts from './modules/debts';


export default new Vuex.Store({
    modules: {
        auth,
        user,
        profile,
        debts
    }
});