import './bootstrap';
import Navigation from './components/Navigation.vue';


Vue.component('side-nav', Navigation);

const app = new Vue({
    el: '#app'
});
