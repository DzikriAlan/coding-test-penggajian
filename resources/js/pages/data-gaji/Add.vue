<template>
  <div class="col-md-12">
      <div class="panel">
          <div class="panel-heading">
              <h3 class="panel-title">Add New PotonganGaji</h3>
          </div>
          <div class="panel-body">
              <FormPotonganGaji></FormPotonganGaji>
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
  import { mapActions, mapState } from 'vuex'
  import FormPotonganGaji from './Form.vue'
  export default {
      name: 'AddPotonganGaji',
      computed: {
          ...mapState('potonganGaji', {
              PotonganGaji: state => state.potonganGaji,
          })
      },
      methods: {
          ...mapActions('potonganGaji', ['submitPotonganGaji']),
          submit() {
              if(this.$route.name == 'potonganGaji.add'){
                  this.submitPotonganGaji().then(() => {
                      this.$router.push({ name: 'potonganGaji.data' })
                      this.$swal({
                          title: 'Data Potongan Gaji berhasil dibuat!',
                          type: 'success',
                          confirmButtonColor: '#3085d6',
                      })
                  })
              }
          }
      },
      components: {
          'FormPotonganGaji': FormPotonganGaji 
      }
  }
</script>