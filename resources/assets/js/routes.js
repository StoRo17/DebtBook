import VueRouter from 'vue-router';
import MainComponent from "./components/Main.vue";
import RegisterForm from './components/forms/Register.vue';
import LoginForm from './components/forms/Login.vue';
import VerificationComponent from './components/Verification.vue';
import VerifyEmailComponent from './components/VerifyEmail.vue';
import NotFoundComponent from './components/NotFound.vue';

let routes = [
    {
        path: '/',
        name: 'main',
        component: MainComponent
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
        component: VerificationComponent,
        beforeEnter: (to, from, next) => {
            if (from.name != 'register') {
                next({name: 'start'});
            } else {
                next();
            }
        }
    },
    {
        path: '/verify-email/:email_token',
        name: 'verifyEmail',
        component: VerifyEmailComponent
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