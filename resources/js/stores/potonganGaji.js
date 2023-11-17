import $axios from '../api.js'

const state = () => ({
    allPotonganGaji: [],
    potonganGaji: {
        potongan: '',
        jml_potongan: '',
    },
    page: 1,
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.allPotonganGaji = payload
    },
    ASSIGN_FORM(state, payload){
        state.potonganGaji = {
            potongan: payload.data.potongan,
            jml_potongan: payload.data.jml_potongan,
        }
    }, 
    CLEAR_FORM(state){
        state.potonganGaji = {
            potongan: '',
            jml_potongan: '',
        }
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
}

const actions = {
    getAllPotonganGaji({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/potongan-gaji?page=${state.page}&search=${search}`)
            .then((response) => {
                let nomor = 1;
                response.data.data.forEach((element, index) => {
                    element['nomor'] = nomor;
                    nomor++;
                });
                commit('ASSIGN_DATA', response.data)
                resolve(response.data)
            })
        })
    },
    submitPotonganGaji({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            $axios.post(`/potongan-gaji/`, state.potonganGaji, {})
            .then((response) => {
                dispatch('getAllPotonganGaji').then(() => {
                    resolve(response.data)
                })
            })
            .catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    },
    editPotonganGaji({ commit, state}, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/potongan-gaji/${payload}/edit`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data)
                resolve(response.data)
            })
        })
    },
    updatePotonganGaji({ state, commit }, payload) {
        console.log(state.potonganGaji);
        return new Promise((resolve, reject) => {
            $axios.put(`/potongan-gaji/${payload}`, state.potonganGaji, {})
            .then((response) => {
                resolve(response.data)
            }).catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    removePotonganGaji({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/potongan-gaji/${payload}`)
            .then((response) => {
                dispatch('getAllPotonganGaji').then(() => resolve(response.data))
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