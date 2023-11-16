import Vue from 'vue'
import router from './router.js'
import store from './store.js'
import App from './App.vue'
import BootstrapVue from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2'
import Permissions from './mixins/Permission.js'

Vue.use(VueSweetalert2)
Vue.use(BootstrapVue)
Vue.mixin(Permissions)

import 'bootstrap-vue/dist/bootstrap-vue.css'
import { mapActions, mapGetters, mapState } from 'vuex'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'

new Vue({
    el: '#dw',
    router,
    store,
    components: {
        App,
    }
})