import Vue from 'vue'
import Vuex from 'vuex'

import auth from './stores/auth.js'
import user from './stores/user.js'
import jabatan from './stores/jabatan.js'
import pegawai from './stores/pegawai.js'
import potonganGaji from './stores/potonganGaji.js'
import dataGaji from './stores/dataGaji.js'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        user,
        jabatan,
        pegawai,
        potonganGaji,
        dataGaji,
    },
    state: {
        token: localStorage.getItem('token'),
        isAdmin: localStorage.getItem('isAdmin'),
        errors: []
    },
    getters: {
        isAuth: state => {
            return state.token != "null" && state.token != null
        },
        isAdmin: state => {
            return state.isAdmin != "null" && state.isAdmin != null
        }
    },
    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_IS_ADMIN(state, payload) {
            state.isAdmin = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        }
    }
})

export default store