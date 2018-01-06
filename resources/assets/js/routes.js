import VueRouter from 'vue-router';
import MainComponent from "./components/Main.vue";
import ProfileComponent from "./components/Profile.vue";
import NewDebtComponent from "./components/forms/NewDebt.vue";
import DebtHistoryComponent from "./components/DebtHistory.vue";
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
        path: '/profile',
        name: 'profile',
        component: ProfileComponent,
        meta: { requiresAuth: true}
    },
    {
        path: '/new-debt',
        name: 'newDebt',
        component: NewDebtComponent,
        meta: { requiresAuth: true }
    },
    {
        path: '/debt/:debtId/history',
        name: 'debtHistory',
        component: DebtHistoryComponent,
        meta: { requiresAuth: true }
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
                next({name: 'main'});
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