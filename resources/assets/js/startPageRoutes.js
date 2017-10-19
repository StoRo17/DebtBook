import VueRouter from 'vue-router';
import StartView from './views/StartView.vue';
import RegisterForm from './components/RegisterForm.vue';
import LoginForm from './components/LoginForm.vue';


const withPrefix = (prefix, routes) =>
    routes.map( (route) => {
        route.path = prefix + route.path;
        return route;
    });


const routes = [
    {
        path: '/',
        name: 'startView',
        component: StartView
    },
    ...withPrefix('/auth', [
        {
            path: '/register',
            name: 'register',
            component: RegisterForm
        },
        {
            path: '/login',
            name: 'login',
            component: LoginForm
        }
    ])
];

export default new VueRouter({
    mode: 'history',
    routes
});
