<template>
    <div class="form-group">
        <label :for="label">{{ label }} <span v-if="required">*</span></label>
        <date-picker v-model="date" :config="options"></date-picker>
        <small class="form-text text-muted" v-if="error != null && error">{{ error[0] }}</small>
    </div>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';

    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

    export default {
        data () {
            return {
                options: {
                    format: 'YYYY-MM-DD h:00:00',
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
                    return this.value || new Date('YYYY-MM-DD h:00:00');
                },
                set: function(){}
            },
        },
        watch: {
            date(){
                this.$emit('changeValue', this.date);
            }
        },
    }
</script>

<style scoped>
    span { color: red; }
</style>