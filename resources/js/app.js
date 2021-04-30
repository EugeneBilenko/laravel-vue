import Vue from 'vue';
import VueRouter from "vue-router";
import routes from './routes';


window.axios = require('axios');
window.moment = require('moment');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('navbar', require('./components/Navbar').default);

Vue.use(VueRouter);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
})

// require('./bootstrap');
