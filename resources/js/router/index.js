import Dashboard from '../views/pages/Dashboard'
import Admin from '../views/pages/Admin'
import Login from '../views/auth/Login'
import Schedule from '../views/pages/Schedule'
import Booking from '../views/pages/Booking'
import Customer from '../views/pages/Customer'


export default {
    mode: 'history',
    // linkExactActiveClass: 'active',
    linkActiveClass: "active",
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
            path: '/admin',
            name: 'Admin',
            component: Admin,
            beforeEnter: (to, from, next) => {
                axios.get('/api/admin').then(()=> { 
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/schedule',
            name: 'Schedule',
            component: Schedule,
            beforeEnter: (to, from, next) => {
                axios.get('/api/schedule').then(() => {
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/booking',
            name: 'Booking',
            component: Booking,
            beforeEnter: (to, from, next) => {
                axios.get('/api/booking').then(() => { 
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/customer',
            name: 'Customer',
            component: Customer,
            beforeEnter: (to, from, next) => {
                axios.get('/api/customer').then(() => { 
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            beforeEach: (to, from, next) => {
                if (localStorage.getItem('token') == '') {
                    next()
                } else next('/dashboard')
            }
        }
    ]
}