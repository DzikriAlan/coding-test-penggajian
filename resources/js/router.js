import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import store from './store.js'

import IndexJabatan from './pages/jabatan/Index.vue'
import DataJabatan from './pages/jabatan/Jabatan.vue'
import AddJabatan from './pages/jabatan/Add.vue'
import EditJabatan from './pages/jabatan/Edit.vue'

import IndexPegawai from './pages/pegawai/Index.vue'
import DataPegawai from './pages/pegawai/Pegawai.vue'
import AddPegawai from './pages/pegawai/Add.vue'
import EditPegawai from './pages/pegawai/Edit.vue'

import IndexPotonganGaji from './pages/potongan-gaji/Index.vue'
import DataPotonganGaji from './pages/potongan-gaji/PotonganGaji.vue'
import AddPotonganGaji from './pages/potongan-gaji/Add.vue'
import EditPotonganGaji from './pages/potongan-gaji/Edit.vue'
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
        {
            path: '/pegawai',
            component: IndexPegawai,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'pegawai.data',
                    component: DataPegawai,
                    meta: { title: 'Manage Pegawai', permissions: ['read pegawai'] }
                },
                {
                    path: 'add',
                    name: 'pegawai.add',
                    component: AddPegawai,
                    meta: { title: 'Add New Pegawai', permissions: ['create pegawai'] }
                },
                {
                    path: 'edit/:id',
                    name: 'pegawai.edit',
                    component: EditPegawai,
                    meta: { title: 'Edit Pegawai', permissions: ['edit pegawai'] }
                },
            ]
        },
        {
            path: '/potongan-gaji',
            component: IndexPotonganGaji,
            meta: { requiresAuth: true },
            children: [
                {
                    path: '',
                    name: 'potonganGaji.data',
                    component: DataPotonganGaji,
                    meta: { title: 'Manage PotonganGaji', permissions: ['read potonganGaji'] }
                },
                {
                    path: 'add',
                    name: 'potonganGaji.add',
                    component: AddPotonganGaji,
                    meta: { title: 'Add New PotonganGaji', permissions: ['create potonganGaji'] }
                },
                {
                    path: 'edit/:id',
                    name: 'potonganGaji.edit',
                    component: EditPotonganGaji,
                    meta: { title: 'Edit PotonganGaji', permissions: ['edit potonganGaji'] }
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
