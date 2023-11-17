<template>
    <header class="main-header">
        {{ authenticated }}
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <router-link to="/" class="navbar-brand"><b>E</b>Salaray</router-link>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><router-link to="/">Home</router-link></li>
                        <li><router-link to="/jabatan">Jabatan</router-link></li>
                        <li><router-link to="/pegawai">Pegawai</router-link></li>
                        <li><router-link to="/potongan-gaji">Potongan Gaji</router-link></li>
                    </ul>
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="https://via.placeholder.com/160" class="user-image" alt="User Image">
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="https://via.placeholder.com/160" class="img-circle" alt="User Image">
                                </li>
                                <li class="user-footer">
                                    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                        <a href="javascript:void(0)" @click="logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import moment from 'moment'
export default {
    computed: {
        ...mapState('user', {
            authenticated: state => state.authenticated
        }),
        ...mapState('notification', {
            notifications: state => state.notifications
        })
    },
    filters: {
        formatDate(val) {
            return moment(new Date(val)).fromNow()
        }
    },
    methods: {
        ...mapActions('notification', ['readNotification']),
        readNotif(row) {
            this.readNotification({ id: row.id}).then(() => this.$router.push({ name: 'expenses.view', params: {id: row.data.expenses.id} }))
        },
        logout(){
            return new Promise((resolve, reject) => {
                localStorage.removeItem('token')
                localStorage.removeItem('isAdmin')
                resolve()
            }).then(() => {
                this.$store.state.token = localStorage.getItem('token')
                this.$store.state.isAdmin = localStorage.getItem('isAdmin')
                this.$router.push('/login')
            })
        }
   }
}
</script>
