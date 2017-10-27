import VueRouter from 'vue-router';
import MainPage from './views/MainView.vue';

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