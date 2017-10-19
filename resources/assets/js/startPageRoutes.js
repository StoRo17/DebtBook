import VueRouter from 'vue-router';
import StartView from './views/StartView.vue';
import RegisterView from './views/RegisterView.vue';
import LoginView from './views/LoginView.vue';


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
            component: RegisterView
        },
        {
            path: '/login',
            name: 'login',
            component: LoginView
        }
    ])
];

export default new VueRouter({
    mode: 'history',
    routes
});
