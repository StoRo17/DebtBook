import VueRouter from 'vue-router';
import StartPage from './views/StartView.vue';

let routes = [
    {
        path: '/',
        name: 'startPage',
        component: StartPage
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});