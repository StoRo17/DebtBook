import Vuex from 'vuex';
import auth from './modules/auth';
import user from './modules/user';
import profile from  './modules/profile';


export default new Vuex.Store({
    modules: {
        auth,
        user,
        profile
    }
});