<template>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Add New Pegawai</h3>
            </div>
            <div class="panel-body">
                <FormPegawai></FormPegawai>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm btn-flat" @click.prevent="submit">
                        <i class="fa fa-save"></i> Add New
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapActions, mapState } from 'vuex'
    import FormPegawai from './Form.vue'
    export default {
        name: 'AddPegawai',
        computed: {
            ...mapState('pegawai', {
                pegawai: state => state.pegawai,
            })
        },
        methods: {
            ...mapActions('pegawai', ['submitPegawai']),
            submit() {
                if(this.$route.name == 'pegawai.add'){
                    this.submitPegawai().then(() => {
                        this.$router.push({ name: 'pegawai.data' })
                        this.$swal({
                            title: 'Pegawai baru berhasil dibuat!',
                            type: 'success',
                            confirmButtonColor: '#3085d6',
                        })
                    })
                }
            }
        },
        components: {
            'FormPegawai': FormPegawai
        }
    }
</script>