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
                date: new Date(),
                options: {
                    format: 'YYYY-MM-DD h:mm:ss',
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