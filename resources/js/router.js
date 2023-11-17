import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import store from './store.js'

import IndexJabatan from './pages/jabatan/Index.vue'
import DataJabatan from './pages/jabatan/Jabatan.vue'
import AddJabatan from './pages/jabatan/Add.vue'
import EditJabatan from './pages/jabatan/Edit.vue'

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
        {
            path: '/jabatan',
            component: IndexJabatan,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'jabatan.data',
                    component: DataJabatan,
                    meta: { title: 'Manage Jabatan', permissions: ['read jabatan'] }
                },
                {
                    path: 'add',
                    name: 'jabatan.add',
                    component: AddJabatan,
                    meta: { title: 'Add New Jabatan', permissions: ['create jabatan'] }
                },
                {
                    path: 'edit/:id',
                    name: 'jabatan.edit',
                    component: EditJabatan,
                    meta: { title: 'Edit Jabatan', permissions: ['edit jabatan'] }
                },
            ]
        },
    ]
});

router.beforeEach(async(to, from, next) => {
    store.commit('CLEAR_ERRORS')
    next();
})

export default router
