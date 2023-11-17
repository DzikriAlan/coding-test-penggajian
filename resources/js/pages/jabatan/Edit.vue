<template>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Jabatan</h3>
            </div>
            <div class="panel-body">
                <FormJabatan></FormJabatan>
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
    import FormJabatan from './Form.vue'
    export default {
        name: 'EditJabatan',
        methods: {
            ...mapActions('jabatan', ['updateJabatan']),
            submit() {
                this.updateJabatan(this.$route.params.id).then(() => {
                    this.$swal({
                        title: 'Jabatan berhasil diubah!',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                    })
                    this.$router.push({ name: 'jabatan.data' });
                })
            }
        },
        components: {
            'FormJabatan': FormJabatan 
        },
    }
</script>