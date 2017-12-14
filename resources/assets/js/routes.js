import VueRouter from 'vue-router';
import RegisterForm from './components/forms/Register.vue';
import LoginForm from './components/forms/Login.vue';

let routes = [
    {
        path: '/sign-up',
        name: 'register',
        component: RegisterForm
    },
    {
        path: '/sign-in',
        name: 'login',
        component: LoginForm
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});