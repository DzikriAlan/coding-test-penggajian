<template>
  <div>
     <div class="form-group" :class="{ 'has-error': errors.potongan }">
          <label for="">Nama Potongan</label>
          <input type="text" class="form-control" v-model="potonganGaji.potongan " />
          <p class="text-danger" v-if="errors.potongan">{{ errors.potongan[0] }}</p>
      </div>
     <div class="form-group" :class="{ 'has-error': errors.jml_potongan }">
          <label for="">Jumlah</label>
          <input type="text" class="form-control" v-model="potonganGaji.jml_potongan" />
          <p class="text-danger" v-if="errors.jml_potongan">{{ errors.jml_potongan [0] }}</p>
      </div>
 </div>
</template>
<script>
  import { mapActions, mapState, mapMutations}from "vuex"
  import vSelect from 'vue-select';
  import _ from 'lodash'
  import 'vue-select/dist/vue-select.css';

  export default {
      name: "FormPotonganGaji",
      created(){
          if (this.$route.name == 'potonganGaji.edit') {
              this.editPotonganGaji(this.$route.params.id)
          }
      },
      computed: {
          ...mapState(["errors"]),
          ...mapState("potonganGaji", {
              potonganGaji: state => state.potonganGaji,
          }),
     },
      methods: {
          ...mapMutations('potonganGaji', ['CLEAR_FORM']),
          ...mapActions("potonganGaji", ['editPotonganGaji']),
      },
      destroyed(){
          this.CLEAR_FORM()
      },
      components: {
          vSelect
      }
  }
</script>