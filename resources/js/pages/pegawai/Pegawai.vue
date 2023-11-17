<template>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <router-link :to="{ name: 'pegawai.add' }" class="btn btn-primary btn-sm btn-flat">Tambah</router-link>
                <div class="pull-right">
                    <input type="text" class="form-control" placeholder="Cari..." v-model="search">
                </div>
            </div>
            <div class="panel-body">
                <b-table striped hover bordered :items="allPegawai.data" :fields="fields" show-empty>
                    <template slot="nomor" slot-scope="row">
                        <p style="text-align: center;">{{ row.item.nomor }}</p>
                    </template>
                    <template slot="nama_pegawai" slot-scope="row">
                        <p>{{ row.item.nama_pegawai }}</p>
                    </template>
                    <template slot="email" slot-scope="row">
                        <p>{{ row.item.email }}</p>
                    </template>
                    <template slot="nik" slot-scope="row">
                        <p>{{ row.item.nik }}</p>
                    </template>
                    <template slot="jenis_kelamin" slot-scope="row">
                        <p>{{ row.item.jenis_kelamin }}</p>
                    </template>
                    <template slot="jabatan" slot-scope="row">
                        <p>{{ row.item.nama_jabatan }}</p>
                    </template>
                    <template slot="actions" slot-scope="row">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <router-link style="margin-right: 5px;" :to="{ name: 'pegawai.edit', params: { id: row.item.id }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></router-link>
                            <button class="btn btn-danger btn-sm" @click="deletePegawai(row.item.id)"><i class="fa fa-trash"></i></button>
                        </div>
                    </template>
               </b-table>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapActions, mapState } from "vuex"
    import moment from 'moment'
    import _ from 'lodash'
    import router from '../../router'
    export default {
        name: 'DataPegawai',
        data(){
            return {
                fields: [
                    { key: "nomor", label: "No" },
                    { key: "nama_pegawai", label: "Nama Pegawai" },
                    { key: "email", label: "Email" },
                    { key: "nik", label: "NIK" },
                    { key: "jenis_kelamin", label: "Jenis Kelamin" },
                    { key: "jabatan", label: "Jabatan" },
                    { key: "status", label: "Status" },
                    { key: "actions", label: "Aksi" },
                ],
                search: '',
                modal: false,
                modalShow: false,
                showBarChart: false,
            }
        },
        created(){
            this.getAllPegawai()
        },
        computed: {
            ...mapState('pegawai', {
                allPegawai: state => state.allPegawai,
            }),
           page: {
                get(){
                    return this.$store.state.pegawai.page
                },
                set(val){
                    this.$store.commit("pegawai/SET_PAGE")
                }
            },
            labels(){
                return ['No', 'Nama', 'Email', 'NIK', 'Jenis Kelamin', 'Status']
            },
        },
        watch: {
            page(){
                return this.getAllPegawai()
            },
            search(){
                return this.getAllPegawai(this.search)
            }
        },
        methods: {
            ...mapActions('pegawai', ["getAllPegawai", "editPegawai", "removePegawai"]),
            deletePegawai(id){
                this.$swal({
                    title: 'Kamu Yakin?',
                    text: "Tindakan ini akan menghapus secara permanent!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Lanjutkan!'
                }).then((result) => {
                    if(result.value){
                        this.removePegawai(id)
                    }
                })
            },
        },
    }
</script>