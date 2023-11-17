<template>
  <div class="col-md-12">
      <div class="panel">
          <div class="panel-heading" style="margin-bottom: 30px;">
              <!-- <router-link :to="{ name: 'dataGaji.add' }" class="btn btn-primary btn-sm btn-flat">Tambah</router-link> -->
              <div class="pull-right">
                  <input type="text" class="form-control" placeholder="Cari..." v-model="search">
              </div>
          </div>
          <div class="panel-body">
              <b-table striped hover bordered :items="allDataGaji.data" :fields="fields" show-empty>
                  <template slot="nomor" slot-scope="row">
                      <p style="text-align: center;">{{ row.item.nomor }}</p>
                  </template>
                  <template slot="nik" slot-scope="row">
                      <p>{{ row.item.nik}}</p>
                  </template>
                  <template slot="nama_pegawai" slot-scope="row">
                      <p>{{ row.item.nama_pegawai }}</p>
                  </template>
                  <template slot="jenis_kelamin" slot-scope="row">
                      <p>{{ row.item.jenis_kelamin }}</p>
                  </template>
                  <template slot="jabatan" slot-scope="row">
                      <p>{{ row.item.nama_jabatan }}</p>
                  </template>
                  <template slot="gaji_pokok" slot-scope="row">
                      <p>Rp.{{ row.item.gaji_pokok }}</p>
                  </template>
                  <template slot="tj_transport" slot-scope="row">
                      <p>Rp.{{ row.item.tj_transport }}</p>
                  </template>
                  <template slot="uang_makan" slot-scope="row">
                      <p>Rp.{{ row.item.uang_makan }}</p>
                  </template>
                  <template slot="jml_potongan" slot-scope="row">
                      <p>Rp.{{ row.item.jml_potongan }}</p>
                  </template>
                  <template slot="total_gaji" slot-scope="row">
                      <p>Rp.{{ row.item.total_gaji }}</p>
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
      name: 'DatadataGaji',
      data(){
          return {
              fields: [
                  { key: "nomor", label: "No" },
                  { key: "nik", label: "NIK" },
                  { key: "nama_pegawai", label: "Nama Pegawai" },
                  { key: "jenis_kelamin", label: "Jenis Kelamin" },
                  { key: "jabatan", label: "Jabatan" },
                  { key: "gaji_pokok", label: "Gaji Pokok" },
                  { key: "tj_transport", label: "Tunjangan Transport" },
                  { key: "uang_makan", label: "Uang Makan" },
                  { key: "jml_potongan", label: "Potongan" },
                  { key: "total_gaji", label: "Total Gaji" },
              ],
              search: '',
              modal: false,
              modalShow: false,
              showBarChart: false,
          }
      },
      created(){
          this.getAllDataGaji()
      },
      computed: {
          ...mapState('dataGaji', {
              allDataGaji: state => state.allDataGaji,
          }),
          labels(){
              return ['No', 'Status']
          },

      },
      watch: {
          page(){
              return this.getAllDataGaji()
          },
          search(){
              return this.getAllDataGaji(this.search)
          }
      },
      methods: {
          ...mapActions('dataGaji', ["getAllDataGaji", "editDataGaji", "removeDataGaji"]),
        },
  }
</script>