import VueRouter from 'vue-router';
import MainPage from './views/app/MainView.vue';
import NotFoundView from './views/NotFoundView.vue';

let routes = [
    {
        path: '/:id',
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