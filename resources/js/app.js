window.axios = require('axios');
window.axios.defaults.withCredentials = true;
import Vue from 'vue'

// Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import router from './router'

// TOasted
import Toasted from 'vue-toasted'
Vue.use(Toasted)

// Datatable
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

// Vue-select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

new Vue({
    el: "#app",
    router: new VueRouter(router),
})