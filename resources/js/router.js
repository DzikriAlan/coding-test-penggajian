import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import store from './store.js'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true, permissions: ['home'] }
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
    ]
});

router.beforeEach(async(to, from, next) => {
    store.commit('CLEAR_ERRORS')
    next();
})

export default router
