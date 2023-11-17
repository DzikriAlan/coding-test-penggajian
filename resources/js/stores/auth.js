import $axios from '../api.js'

const state = () => ({

})

const mutations = {
    
}

const actions = {
    submit({ commit }, payload) {
        localStorage.setItem('token', null)
        localStorage.setItem('isAdmin', null)
        commit('SET_TOKEN', null, { root: true })
        commit('SET_IS_ADMIN', null, { root: true })
        return new Promise((resolve, reject) => {
            $axios.post('/login', payload)
            .then((response) => {
                if (response.data.status == 'success') {
                    localStorage.setItem('token', response.data.data)
                    localStorage.setItem('isAdmin', response.data.isAdmin)
                    commit('SET_TOKEN', response.data.data, { root: true })
                    commit('SET_IS_ADMIN', response.data.isAdmin, { root: true })
                } else {
                    commit('SET_ERRORS', { invalid: 'Email/Password Salah' }, { root: true })
                }
                resolve(response.data)
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}