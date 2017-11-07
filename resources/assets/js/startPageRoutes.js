import VueRouter from 'vue-router';
import StartView from './views/startPage/StartView.vue';
import VerificationView from './views/startPage/VerificationView.vue';
import EmailConfirmedView from './views/startPage/EmailConfirmedView.vue';
import NotFoundView from './views/NotFoundView.vue';
import RegisterForm from './components/forms/RegisterForm.vue';
import LoginForm from './components/forms/LoginForm.vue';


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
    ]),
    {
        path: '/verification',
        name: 'verification',
        component: VerificationView
    },
    {
        path: '/email-confirmed',
        name: 'emailConfirmed',
        component: EmailConfirmedView
    },
    {
        path: '*',
        component: NotFoundView
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});
