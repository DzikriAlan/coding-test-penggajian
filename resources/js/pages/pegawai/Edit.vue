<template>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Pegawai</h3>
            </div>
            <div class="panel-body">
                <FormPegawai></FormPegawai>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm btn-flat" @click.prevent="submit">
                        <i class="fa fa-save"></i> Update
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
        name: 'EditPegawai',
        methods: {
            ...mapActions('pegawai', ['updatePegawai']),
            submit() {
                this.updatePegawai(this.$route.params.id).then(() => {
                    this.$router.push({ name: 'pegawai.data' })
                })
                this.$swal({
                    title: 'Data Pegawai berhasil diubah!',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                })
            }
        },
        components: {
            'FormPegawai': FormPegawai 
        },
    }
</script>