import $axios from '../api.js'

const state = () => ({
    allJabatan: [],
    jabatan: {
       nama_jabatan: '' ,
       gaji_pokok: '' ,
       tj_transport: '' ,
       uang_makan: '' ,
    },
    page: 1,
    id: ''
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.allJabatan = payload
    },
    ASSIGN_FORM(state, payload){
        state.jabatan = {
            nama_jabatan: payload.data.nama_jabatan ,
            gaji_pokok: payload.data.gaji_pokok ,
            tj_transport: payload.data.tj_transport ,
            uang_makan: payload.data.uang_makan ,
        }
    }, 
    CLEAR_FORM(state){
        state.jabatan = {
            nama_jabatan: '' ,
            gaji_pokok: '' ,
            tj_transport: '' ,
            uang_makan: '' ,
        }
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
}

const actions = {
    getAllJabatan({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/jabatan?page=${state.page}&search=${search}`)
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
    submitJabatan({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            $axios.post(`/jabatan`, state.jabatan, {})
            .then((response) => {
                dispatch('getAllJabatan').then(() => {
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
    editJabatan({ commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/jabatan/${payload}/edit`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data)
                resolve(response.data)
            })
        })
    },
    updateJabatan({ state, commit }, payload) {
        return new Promise((resolve, reject) => {
            $axios.put(`/jabatan/${payload}`, state.jabatan, {})
            .then((response) => {
                resolve(response.data)
                this.$swal({
                    title: 'Jabatan berhasil diubah!',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                })

            }).catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    removeJabatan({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/jabatan/${payload}`)
            .then((response) => {
                dispatch('getAllJabatan').then(() => resolve(response.data))
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