import VueRouter from 'vue-router';
import StartComponent from "./components/Start.vue";
import RegisterForm from './components/forms/Register.vue';
import LoginForm from './components/forms/Login.vue';
import VerificationComponent from './components/Verification.vue';
import EmailConfirmedComponent from './components/EmailConfirmed.vue';
import NotFoundComponent from './components/NotFound.vue';

let routes = [
    {
        path: '/',
        name: 'start',
        component: StartComponent
    },
    {
        path: '/sign-up',
        name: 'register',
        component: RegisterForm
    },
    {
        path: '/sign-in',
        name: 'login',
        component: LoginForm
    },
    {
        path: '/verification',
        name: 'verification',
        component: VerificationComponent
    },
    {
        path: '/email-confirmed',
        name: 'emailConfirmed',
        component: EmailConfirmedComponent
    },
    {
        path: '*',
        component: NotFoundComponent
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});