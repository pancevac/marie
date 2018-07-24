<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/permissions'">Grupe dozvola</router-link></li>
                            <li>Izmena grupu dozvola</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena grupu dozvola</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()" v-if="permission_group">

                            <text-field :value="permission_group.name" :label="'Ime'" :error="error? error.name : ''" :required="true" @changeValue="permission_group.name = $event"></text-field>

                            <text-field :value="permission_group.order" :label="'Redosled'" :error="error? error.order : ''" :required="true" @changeValue="permission_group.order = $event"></text-field>

                            <checkbox-field :value="permission_group.is_visible" :label="'Publikovano'" @changeValue="permission_group.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
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
              fillable: ['name', 'is_visible'],
              permission_group: false,
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
        mounted(){
            this.getPermissionGroups();
        },
        methods: {
            getPermissionGroups(){
                axios.get('api/permission-groups/' + this.$route.params.id)
                    .then(res => {
                        this.permission_group = res.data.permission_group;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                let data = fillForm(this.fillable, this.permission_group, 'PUT')
                axios.post('api/permission-groups/' + this.permission_group.id, data)
                    .then(res => {
                        this.permission_group = res.data.permission_group;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        },
    }
</script>