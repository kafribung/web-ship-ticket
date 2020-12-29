import Dashboard from '../views/pages/Dashboard'
import Login from '../views/auth/Login'
export default {
    mode: 'history',
    routes: [
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
        }
    ]
}