<template>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Add New Jabatan</h3>
            </div>
            <div class="panel-body">
                <FormJabatan></FormJabatan>
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
    import { mapActions, mapState, mapMutations } from 'vuex'
    import FormJabatan from './Form.vue'
    export default {
        name: 'AddJabatan',
        data() {
            return {
                
            }
        },
        methods: {
            ...mapActions('jabatan', ['submitJabatan']),
            submit() {
                if(this.$route.name == 'jabatan.add'){
                    this.submitJabatan().then(() => {
                        this.$router.push({ name: 'jabatan.data' });
                        this.$swal({
                            title: 'Jabatan baru berhasil dibuat!',
                            type: 'success',
                            confirmButtonColor: '#3085d6',
                        })
                    })
                }
            }
        },
        components: {
            'FormJabatan': FormJabatan 
        }
    }
</script>