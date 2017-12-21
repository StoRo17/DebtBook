import Vuex from 'vuex';
import auth from './modules/auth'
import user from './modules/user';

export default new Vuex.Store({
    modules: {
        auth,
        user
    }
});