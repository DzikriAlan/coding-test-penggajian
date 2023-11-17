<template>
    <div>
        <div class="form-group" :class="{ 'has-error': errors.nama_jabatan }">
            <label for="">Nama Jabatan</label>
            <input type="text" class="form-control" v-model="jabatan.nama_jabatan" />
            <p class="text-danger" v-if="errors.nama_jabatan">{{ errors.nama_jabatan[0] }}</p>
        </div>
        <div class="form-group" :class="{ 'has-error': errors.gaji_pokok }">
            <label for="">Gaji Pokok</label>
            <input
                type="text"
                class="form-control"
                v-model="formattedGajiPokok"
                @input="updateRealValueGajiPokok"
            />
            <p class="text-danger" v-if="errors.gaji_pokok">{{ errors.gaji_pokok[0] }}</p>
        </div>
        <div class="form-group" id="uang" :class="{ 'has-error': errors.tj_transport }">
            <label for="">Tunjangan Transport</label>
            <input
                type="text"
                class="form-control"
                v-model="formattedTjTransport"
                @input="updateRealValueTjTransport"
            />
            <p class="text-danger" v-if="errors.tj_transport">{{ errors.tj_transport[0] }}</p>
        </div>
        <div class="form-group" id="uang" :class="{ 'has-error': errors.uang_makan }">
            <label for="">Uang Makan</label>
            <input
                type="text"
                class="form-control"
                v-model="formattedUangMakan"
                @input="updateRealValueUangMakan"
            />
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
            formattedGajiPokok: {
                get() {
                    return this.formatToRupiahGajiPokok(this.jabatan.gaji_pokok);
                },
                set(value) {
                    this.jabatan.gaji_pokok = this.formatToNumberGajiPokok(value);
                },
            },
            formattedTjTransport: {
                get() {
                    return this.formatToRupiahTjTransport(this.jabatan.tj_transport);
                },
                set(value) {
                    this.jabatan.tj_transport= this.formatToNumberTjTransport(value);
                },
            },
            formattedUangMakan: {
                get() {
                    return this.formatToRupiahUangMakan(this.jabatan.uang_makan);
                },
                set(value) {
                    this.jabatan.uang_makan = this.formatToNumberUangMakan(value);
                },
            },
       },
        methods: {
            ...mapMutations('jabatan', ['CLEAR_FORM']),
            ...mapActions("jabatan", ['getAllJabatan', 'submitJabatan', 'editJabatan']),
            formatToRupiahGajiPokok(value) {
                return value.toLocaleString('id-ID');
            },
            formatToNumberGajiPokok(value) {
                return Number(value.replace(/[^\d]/g, '')) || 0;
            },
            formatToRupiahTjTransport(value) {
                return value.toLocaleString('id-ID');
            },
            formatToNumberTjTransport(value) {
                return Number(value.replace(/[^\d]/g, '')) || 0;
            },
            formatToRupiahUangMakan(value) {
                return value.toLocaleString('id-ID');
            },
            formatToNumberUangMakan(value) {
                return Number(value.replace(/[^\d]/g, '')) || 0;
            },
            updateRealValueGajiPokok(event) {
                this.jabatan.gaji_pokok = this.formatToNumberGajiPokok(event.target.value);
            },
            updateRealValueTjTransport(event) {
                this.jabatan.tj_transport = this.formatToNumberTjTransport(event.target.value);
            },
            updateRealValueUangMakan(event) {
                this.jabatan.uang_makan = this.formatToNumberUangMakan(event.target.value);
            },
        },
        destroyed(){
            this.CLEAR_FORM()
        },
        components: {
            vSelect
        }
    }
</script>