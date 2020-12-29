window.axios = require('axios');
window.axios.defaults.withCredentials = true;
import Vue from 'vue'

// Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import router from './router'

// Vue Cookie
import VueCookie from 'vue-cookie'
Vue.use(VueCookie)

new Vue({
    el: "#app",
    router: new VueRouter(router),
})