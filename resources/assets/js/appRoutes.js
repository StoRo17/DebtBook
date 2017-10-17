import VueRouter from 'vue-router';
import MainPage from './views/MainPage.vue';

let routes = [
    {
        path: '/',
        name: 'main',
        component: MainPage
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});