import VueRouter from 'vue-router';
import StartView from './views/StartView.vue';
import RegisterView from './views/RegisterView.vue';
import LoginView from './views/LoginView.vue';


let routes = [
    {
        path: '/',
        name: 'startView',
        component: StartView
    },
    {
        path: '/auth/register',
        name: 'register',
        component: RegisterView
    },
    {
        path: '/auth/login',
        name: 'auth',
        component: LoginView
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});
