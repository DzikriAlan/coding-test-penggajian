<template>
    <div>
        <div class="form-group" :class="{ 'has-error': errors.jabatan_id }">
            <label for="">Jabatan</label>
            <select v-model="pegawai.jabatan_id" class="form-control">
                <option value="">Pilih</option>
                <option v-for="(row, index) in allJabatan.data" :key="index" :value="row.id">{{ row.nama_jabatan }}</option>
            </select>
            <p class="text-danger" v-if="errors.jabatan_id">{{ errors.jabatan_id[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.nama_pegawai }">
            <label for="">Nama</label>
            <input type="text" class="form-control" v-model="pegawai.nama_pegawai" />
            <p class="text-danger" v-if="errors.nama_pegawai">{{ errors.nama_pegawai[0] }}</p>
        </div>
        <div v-if="this.$route.name == 'pegawai.add'" class="form-group" :class="{ 'has-error': errors.password }">
            <label for="">Password</label>
            <input type="password" class="form-control" v-model="pegawai.password" />
            <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.email}">
            <label for="">Email</label>
            <input type="email" class="form-control" v-model="pegawai.email" />
            <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.nik}">
            <label for="">NIK</label>
            <input type="text" class="form-control" v-model="pegawai.nik" />
            <p class="text-danger" v-if="errors.nik">{{ errors.nik[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.jenis_kelamin }">
            <label for="">Jenis Kelamin</label>
            <select v-model="pegawai.jenis_kelamin" class="form-control">
                <option value="">Pilih</option>
                <option v-for="(row, index) in jenis_kelamin" :key="index" :value="row.nama_kelamin">{{ row.nama_kelamin }}</option>
            </select>
            <p class="text-danger" v-if="errors.jenis_kelamin">{{ errors.jenis_kelamin[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.status }">
            <label for="">Status</label>
            <select v-model="pegawai.status" class="form-control">
                <option value="">Pilih</option>
                <option v-for="(row, index) in status" :key="index" :value="row.nama_status">{{ row.nama_status }}</option>
            </select>
            <p class="text-danger" v-if="errors.status">{{ errors.status[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.status }">
            <label for="">Hak Akses</label>
            <select v-model="pegawai.hak_akses" class="form-control">
                <option value="">Pilih</option>
                <option v-for="(row, index) in roles" :key="index" :value="row.id">{{ row.nama_hak_akses }}</option>
            </select>
            <p class="text-danger" v-if="errors.status">{{ errors.status[0] }}</p>
        </div>

   </div>
</template>
<script>
    import { mapActions, mapState, mapMutations}from "vuex"
    import vSelect from 'vue-select';
    import _ from 'lodash'
    import 'vue-select/dist/vue-select.css';

    export default {
        name: "FormPegawai",
        data(){
            return {
                jabatan_id: '',
                status: [
                    { id: 1, nama_status: 'Pegawai Tetap' },
                    { id: 2, nama_status: 'Pegawai Tidak Tetap' },
                ],
                roles: [
                    { id: 1, nama_hak_akses: 'Admin' },
                    { id: 2, nama_hak_akses: 'Pegawai' },
                ],
                jenis_kelamin: [
                    { id: 1, nama_kelamin: 'Laki-Laki' },
                    { id: 2, nama_kelamin: 'Perempuan' },
                ]

            }
        },
        created(){
            this.getAllJabatan();
            if (this.$route.name == 'pegawai.edit') {
                this.editPegawai(this.$route.params.id)
            }
        },
        computed: {
            ...mapState(["errors"]),
            ...mapState("pegawai", {
                pegawai: state => state.pegawai,
            }),
            ...mapState('jabatan', {
                allJabatan: state => state.allJabatan,
            })
       },
        methods: {
            ...mapMutations('pegawai', ['CLEAR_FORM']),
            ...mapActions("pegawai", ['editPegawai']),
            ...mapActions("jabatan", ['getAllJabatan']),
        },
        destroyed(){
            this.CLEAR_FORM()
        },
        components: {
            vSelect
        }
    }
</script>