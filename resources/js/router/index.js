import Dashboard from '../views/pages/Dashboard'
import Login from '../views/auth/Login'
import VueCookie from 'vue-cookie'

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            redirect: '/dashboard'
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard,
            beforeEnter: (to, from, next) => {
                axios.get('/api/dashboard').then(()=> { 
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            beforeEnter: (to, from, next) => {
                if (localStorage.getItem('token') == '') {
                    next()
                } else next('/dashboard')
            }
        }
    ]
}