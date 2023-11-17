<template>
  <div class="col-md-12">
      <div class="panel">
          <div class="panel-heading">
              <h3 class="panel-title">Edit Potongan Gaji</h3>
          </div>
          <div class="panel-body">
              <FormPotonganGaji></FormPotonganGaji>
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
  import FormPotonganGaji from './Form.vue'
  export default {
      name: 'EditPotonganGaji',
      methods: {
          ...mapActions('potonganGaji', ['updatePotonganGaji']),
          submit() {
              this.updatePotonganGaji(this.$route.params.id).then(() => {
                  this.$router.push({ name: 'potonganGaji.data' })
                  this.$swal({
                      title: 'Data Potongan Gaji berhasil diubah!',
                      type: 'success',
                      confirmButtonColor: '#3085d6',
                  })
              })
          }
      },
      components: {
          'FormPotonganGaji': FormPotonganGaji 
      },
  }
</script>