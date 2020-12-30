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

new Vue({
    el: "#app",
    router: new VueRouter(router),
})