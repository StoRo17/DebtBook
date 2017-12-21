import './bootstrap';
import router from './routes';
import store from './store/index';
import App from './App.vue';


Vue.component('app', App); 


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.isLoggedIn) {
            next({name: 'login'});
        } else {
            next();
        }
    } else {
        next();
    }
})

const vm = new Vue({
    el: '#root',
    router,
    store
});
