import VueRouter from 'vue-router';
import StartView from './views/StartView.vue';
import VerificationView from './views/VerificationView.vue';
import EmailConfirmedView from './views/EmailConfirmedView.vue';
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
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});
