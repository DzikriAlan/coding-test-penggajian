import $axios from '../api.js'

const state = () => ({
    allPegawai: [],
    pegawai: {
        jabatan_id: '',
        nama_pegawai: '' ,
        email: '' ,
        password: '' ,
        nik: '' ,
        jenis_kelamin: '' ,
        status: '' ,
        hak_akses: '',
    },
    page: 1,
    id: ''
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.allPegawai = payload
    },
    ASSIGN_FORM(state, payload){
        state.pegawai = {
            jabatan_id: payload.data.jabatan_id,
            nama_pegawai: payload.data.nama_pegawai,
            email: payload.data.email,
            password: payload.data.password,
            nik: payload.data.nik,
            jenis_kelamin: payload.data.jenis_kelamin,
            status: payload.data.status,
            hak_akses: payload.data.hak_akses
        }
    }, 
    CLEAR_FORM(state){
        state.pegawai = {
            jabatan_id: '',
            nama_pegawai: '' ,
            email: '' ,
            password: '' ,
            nik: '' ,
            jenis_kelamin: '' ,
            status: '' ,
            hak_akses: '' ,
        }
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
}

const actions = {
    getAllPegawai({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/pegawai?page=${state.page}&search=${search}`)
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
    submitPegawai({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            $axios.post(`/pegawai`, state.pegawai, {})
            .then((response) => {
                dispatch('getAllPegawai').then(() => {
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
    editPegawai({ commit, state}, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/pegawai/${payload}/edit`)
            .then((response) => {
              console.log(response.data);
                commit('ASSIGN_FORM', response.data)
                resolve(response.data)
            })
        })
    },
    updatePegawai({ state, commit }, payload) {
        console.log(state.pegawai);
        return new Promise((resolve, reject) => {
            $axios.put(`/pegawai/${payload}`, state.pegawai, {})
            .then((response) => {
                resolve(response.data)
            }).catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    removePegawai({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/pegawai/${payload}`)
            .then((response) => {
                dispatch('getAllPegawai').then(() => resolve(response.data))
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