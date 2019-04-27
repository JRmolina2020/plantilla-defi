/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Vuetify = require('vuetify');
window.Axios = require('axios');
window.Swal = require('sweetalert2');
import store from './store';



Vue.component(
    'Home',
    require('./components/Home.vue')
);


Vue.component(
    'Navbar',
    require('./components/Navbar')
);

Vue.component(
    'categorie',
    require('./components/Categorie/categorie.vue')
);
Vue.component(
    'add',
    require('./components/Categorie/add.vue')
);

const app = new Vue({
    el: '#app',
    store
});
