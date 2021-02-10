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
                const token = localStorage.getItem('token')
                const accessToken = {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                }
                axios.get('/api/dashboard', accessToken)
                    .then(() => { 
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/admin',
            name: 'Admin',
            component: Admin,
            beforeEnter: (to, from, next) => {
                const token = localStorage.getItem('token')
                const accessToken = {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                }
                axios.get('/api/admin', accessToken).then(()=> { 
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/schedule',
            name: 'Schedule',
            component: Schedule,
            beforeEnter: (to, from, next) => {
                const token = localStorage.getItem('token')
                const accessToken = {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                }
                axios.get('/api/schedule', accessToken).then(() => {
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/booking',
            name: 'Booking',
            component: Booking,
            beforeEnter: (to, from, next) => {
                const token = localStorage.getItem('token')
                const accessToken = {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                }
                axios.get('/api/booking', accessToken).then(() => { 
                    next()
                }).catch(() => next('/login'))
            }
        },
        {
            path: '/customer',
            name: 'Customer',
            component: Customer,
            beforeEnter: (to, from, next) => {
                const token = localStorage.getItem('token')
                const accessToken = {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                }
                axios.get('/api/customer', accessToken).then(() => { 
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