import $axios from '../api.js'

const state = () => ({
    allDataGaji: [],
    dataGaji: {
        nik: '',
        nama_pegawai: '',
        jenis_kelamin: '',
        jabatan: '',
        gaji_pokok: '',
        tj_transport: '',
        uang_makan: '',
        jml_potongan: '',
        total_gaji: '',
    },
    page: 1,
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.allDataGaji = payload
    },
    ASSIGN_FORM(state, payload){
        state.dataGaji = {
          nik: '',
          nama_pegawai: '',
          jenis_kelamin: '',
          jabatan: '',
          gaji_pokok: '',
          tj_transport: '',
          uang_makan: '',
          jml_potongan: '',
          total_gaji: '',
        }
    }, 
    CLEAR_FORM(state){
        state.dataGaji = {
          nik: '',
          nama_pegawai: '',
          jenis_kelamin: '',
          jabatan: '',
          gaji_pokok: '',
          tj_transport: '',
          uang_makan: '',
          jml_potongan: '',
          total_gaji: '',
        }
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
}

const actions = {
    getAllDataGaji({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/data-gaji?page=${state.page}&search=${search}`)
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
    submitDataGaji({ dispatch, commit, state }) {
        return new Promise((resolve, reject) => {
            $axios.post(`/data-gaji/`, state.dataGaji, {})
            .then((response) => {
                dispatch('getAllDataGaji').then(() => {
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
    editDataGaji({ commit, state}, payload) {
        return new Promise((resolve, reject) => {
            $axios.get(`/data-gaji/${payload}/edit`)
            .then((response) => {
                commit('ASSIGN_FORM', response.data)
                resolve(response.data)
            })
        })
    },
    updateDataGaji({ state, commit }, payload) {
        console.log(state.dataGaji);
        return new Promise((resolve, reject) => {
            $axios.put(`/data-gaji/${payload}`, state.dataGaji, {})
            .then((response) => {
                resolve(response.data)
            }).catch((error) => {
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    } ,
    removeDataGaji({ dispatch }, payload) {
        return new Promise((resolve, reject) => {
            $axios.delete(`/data-gaji/${payload}`)
            .then((response) => {
                dispatch('getAllDataGaji').then(() => resolve(response.data))
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