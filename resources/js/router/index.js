import Dashboard from '../views/pages/Dashboard'
import Admin from '../views/pages/Admin'
import Login from '../views/auth/Login'
import Schedule from '../views/pages/Schedule'

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