import VueRouter from 'vue-router';
import StartView from './views/StartView.vue';

let routes = [
    {
        path: '/',
        name: 'startView',
        component: StartView
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});
