<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/permissions'">Dozvole</router-link></li>
                            <li>Kreiranje dozvole</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje dozvole</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="permission.name" :label="'Ime'" :error="error? error.name : ''" :required="true" @changeValue="permission.name = $event"></text-field>

                            <text-field :value="permission.guard_name" :label="'Zaštićeno ime'" :error="error? error.guard_name : ''" :required="true" @changeValue="permission.guard_name = $event"></text-field>

                            <checkbox-field :value="permission.is_visible" :label="'Publikovano'" @changeValue="permission.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              fillable: ['name', 'guard_name', 'is_visible'],
              permission: {
                  name: null,
              },
              error: null,
          }
        },
        computed: {
            user(){
                return this.$store.getters['user/getUser'];
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        methods: {
            submit(){
                let data = fillForm(this.fillable, this.permission)
                axios.post('api/permissions', data)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/permissions');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        },
        watch: {
            'permission.name'(){
                this.permission.guard_name = Slug(this.permission.name);
            }
        },
    }
</script>