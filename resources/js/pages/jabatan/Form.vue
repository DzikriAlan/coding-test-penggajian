<template>
    <div>
        <div class="form-group" :class="{ 'has-error': errors.nama_jabatan }">
            <label for="">Nama Jabatan</label>
            <input type="text" class="form-control" v-model="jabatan.nama_jabatan" />
            <p class="text-danger" v-if="errors.nama_jabatan">{{ errors.nama_jabatan[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.gaji_pokok }">
            <label for="">Gaji Pokok</label>
            <input type="text" id="uang" class="form-control" v-model="jabatan.gaji_pokok" />
            <p class="text-danger" v-if="errors.gaji_pokok">{{ errors.gaji_pokok[0] }}</p>
        </div>
        <div class="form-group" id="uang" :class="{ 'has-error': errors.tj_transport }">
            <label for="">Tunjangan Transport</label>
            <input type="text" class="form-control" v-model="jabatan.tj_transport" />
            <p class="text-danger" v-if="errors.tj_transport">{{ errors.tj_transport[0] }}</p>
        </div>
        <div class="form-group" id="uang" :class="{ 'has-error': errors.uang_makan }">
            <label for="">Uang Makan</label>
            <input type="text" class="form-control" v-model="jabatan.uang_makan" />
            <p class="text-danger" v-if="errors.uang_makan">{{ errors.uang_makan[0] }}</p>
        </div>
   </div>
</template>
<script>
    import { mapActions, mapState, mapMutations}from "vuex"
    import vSelect from 'vue-select';
    import _ from 'lodash'
    import 'vue-select/dist/vue-select.css';

    export default {
        name: "FormJabatan",
        created(){
            this.getAllJabatan();
            if (this.$route.name == 'jabatan.edit') {
                this.editJabatan(this.$route.params.id);
            }
        },
        computed: {
            ...mapState(["errors"]),
            ...mapState("jabatan", {
                jabatan: state => state.jabatan
            }),
       },
        methods: {
            ...mapMutations('jabatan', ['CLEAR_FORM']),
            ...mapActions("jabatan", ['getAllJabatan', 'submitJabatan', 'editJabatan']),
        },
        destroyed(){
            this.CLEAR_FORM()
        },
        components: {
            vSelect
        }
    }
</script>