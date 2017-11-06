import VueRouter from 'vue-router';
import MainPage from './views/MainView.vue';
import NotFoundView from './views/NotFoundView.vue';

let routes = [
    {
        path: '/',
        name: 'main',
        component: MainPage
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