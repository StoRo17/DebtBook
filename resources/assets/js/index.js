import './bootstrap';
import router from './routes';
import App from './App.vue';


Vue.component('app', App); 

const vm = new Vue({
    el: '#root',
    router
});
