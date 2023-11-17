<template>
  <div class="col-md-12">
      <div class="panel">
          <div class="panel-heading">
              <router-link :to="{ name: 'potonganGaji.add' }" class="btn btn-primary btn-sm btn-flat">Tambah</router-link>
              <div class="pull-right">
                  <input type="text" class="form-control" placeholder="Cari..." v-model="search">
              </div>
          </div>
          <div class="panel-body">
              <b-table striped hover bordered :items="allPotonganGaji.data" :fields="fields" show-empty>
                  <template slot="nomor" slot-scope="row">
                      <p style="text-align: center;">{{ row.item.nomor }}</p>
                  </template>
                  <template slot="potongan" slot-scope="row">
                      <p>{{ row.item.potongan }}</p>
                  </template>
                  <template slot="jml_potongan" slot-scope="row">
                      <p>Rp.{{ row.item.jml_potongan }}</p>
                  </template>
                  <template slot="actions" slot-scope="row">
                    <div style="display: flex; justify-content: center; align-items: center;">
                      <router-link style="margin-right: 5px;" :to="{ name: 'potonganGaji.edit', params: { id: row.item.id }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></router-link>
                      <button class="btn btn-danger btn-sm" @click="deletePotonganGaji(row.item.id)"><i class="fa fa-trash"></i></button>
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
      name: 'DataPotonganGaji',
      data(){
          return {
              fields: [
                  { key: "nomor", label: "No" },
                  { key: "potongan", label: "Potongan" },
                  { key: "jml_potongan", label: "Jumlah" },
                  { key: "actions", label: "Aksi" },
              ],
              search: '',
              modal: false,
              modalShow: false,
              showBarChart: false,
          }
      },
      created(){
          this.getAllPotonganGaji()
      },
      computed: {
          ...mapState('potonganGaji', {
              allPotonganGaji: state => state.allPotonganGaji,
          }),
          labels(){
              return ['No', 'Status']
          },

      },
      watch: {
          page(){
              return this.getAllPotonganGaji()
          },
          search(){
              return this.getAllPotonganGaji(this.search)
          }
      },
      methods: {
          ...mapActions('potonganGaji', ["getAllPotonganGaji", "editPotonganGaji", "removePotonganGaji"]),
          deletePotonganGaji(id){
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
                      this.removePotonganGaji(id)
                  }
              })
          },
      },
  }
</script>