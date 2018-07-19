<template>
    <div class="form-group">
        <label :for="label">{{ label }} <span v-if="required">*</span></label>
        <date-picker v-model="date" :config="options" @dp-change="changeValue()"></date-picker>
        <small class="form-text text-muted" v-if="error != null && error">{{ error[0] }}</small>
    </div>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    import moment from 'moment';

    export default {
        data () {
            return {
                options: {
                    format: 'YYYY-MM-DD H:00:00',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                }
            }
        },
        props: ['label', 'value', 'error', 'required'],
        components: {
            datePicker,
        },
        computed: {
            date:{
                get: function(){
                    return this.value;
                },
                set: function(){}
            },
        },
        methods: {
            changeValue(){
                this.$emit('changeValue', moment(this.date).format('YYYY-MM-DD HH:00:00').toString());
            },
        },
    }
</script>

<style scoped>
    span { color: red; }
</style>