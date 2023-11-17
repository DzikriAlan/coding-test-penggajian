import $axios from '../api.js'

const state = () => ({
    users: [],
    authenticated: [],
})

const mutations = {
    ASSIGN_USER(state, payload) {
        state.users = payload
    },
    ASSIGN_USER_AUTH(state, payload) {
        state.authenticated = payload; 
    },

}

const actions = {
    getUserLogin({commit, state}) {
      return new Promise((resolve, reject) => {
        $axios.get('/user-authenticated').then((response) => {
          commit('ASSIGN_USER_AUTH', response.data.data)
            resolve(response.data)
        })
    })
  }
}

export default {
    namespaced: true,
    state, 
    mutations,
    actions
}