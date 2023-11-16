<template>
    <div class="container">
        <section class="content-header">
            <h1>
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><router-link :to="'/'"><i class="fa fa-dashboard"></i> Home</router-link></li>
                <li><a href="#">Dashboard</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import moment from 'moment'
    import _ from 'lodash'
    import { mapActions, mapState } from 'vuex'
    export default {
        created() {
            this.getUserLogin()
        },
        computed: {
            ...mapState('user', {
                authenticated: state => state.authenticated,
            }),
            ...mapState(['token']),
        },
        methods: {
            ...mapActions('user', ['getUserLogin']),
            exportData() {
                window.open(`/api/export?api_token=${this.token}&month=${this.month}&year=${this.year}`)
            }
        },
    }
</script>
