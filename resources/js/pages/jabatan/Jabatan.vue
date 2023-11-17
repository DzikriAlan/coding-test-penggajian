<template>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <router-link :to="{ name: 'jabatan.add' }" class="btn btn-primary btn-sm btn-flat">Tambah</router-link>
                <div class="pull-right">
                    <input type="text" class="form-control" placeholder="Cari..." v-model="search">
                </div>
            </div>
            <div class="panel-body">
                <b-table striped hover bordered :items="allJabatan.data" :fields="fields" show-empty>
                    <template slot="nomor" slot-scope="row">
                        <p style="text-align: center;"><strong>{{ row.item.nomor }}</strong></p>
                    </template>
                    <template slot="desa_id" slot-scope="row">
                        <p><strong>{{ row.item.nama_jabatan }}</strong></p>
                    </template>
                    <template slot="no_jabatan" slot-scope="row">
                        <p><strong>{{ row.item.gaji_pokok }}</strong></p>
                    </template>
                    <template slot="jumlah_dpt" slot-scope="row">
                        <p><strong>{{ row.item.tj_transport }}</strong></p>
                    </template>
                    <template slot="jumlah_konstituen" slot-scope="row">
                        <p><strong>{{ row.item.uang_makan }}</strong></p>
                    </template>
                    <template slot="actions" slot-scope="row">
                        <router-link :to="{ name: 'jabatan.edit', params: { id: row.item.id }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></router-link>
                        <button class="btn btn-danger btn-sm" @click="deleteJabatan(row.item.id)"><i class="fa fa-trash"></i></button>
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
        name: 'DataJabatan',
        data(){
            return {
                fields: [
                    { key: "nomor", label: "No" },
                    { key: "nama_jabatan", label: "Nama Jabatan" },
                    { key: "gaji_pokok", label: "Gaji Pokok" },
                    { key: "tj_transport", label: "Tunjangan Transport" },
                    { key: "uang_makan", label: "Uang Makan" },
                    { key: "actions", label: "Aksi" },
                ],
                search: '',
                modal: false,
                modalShow: false,
                showBarChart: false,
            }
        },
        created(){
            this.getAllJabatan()
        },
        computed: {
            ...mapState('jabatan', {
                allJabatan: state => state.allJabatan,
            }),
           page: {
                get(){
                    return this.$store.state.jabatan.page
                },
                set(val){
                    this.$store.commit("jabatan/SET_PAGE")
                }
            },
            labels(){
                return ['No', 'Nama Jabatan', 'Gaji Pokok', 'Tunjangan Transport']
            },
        },
        watch: {
            page(){
                return this.getAllJabatan()
            },
            search(){
                return this.getAllJabatan(this.search)
            }
        },
        methods: {
            ...mapActions('jabatan', ["getAllJabatan", "editJabatan", "removeJabatan"]),
            deleteJabatan(id){
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
                        this.removeJabatan(id)
                    }
                })
            },
        },
    }
</script>