import VueRouter from 'vue-router';
import MainView from './views/app/MainView.vue';
import ProfileView from './views/app/ProfileView.vue';
import NotFoundView from './views/NotFoundView.vue';

let routes = [
    {
        path: '/user/:id',
        name: 'user',
        component: MainView
    },
    {
        path: '/user/:id/profile',
        name: 'profile',
        component: ProfileView
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