<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/users'">Korisnici</router-link></li>
                            <li>Kreiranje korisnika</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje korisnika</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="user.name" :label="'Ime'" :error="error? error.name : ''" :required="true" @changeValue="user.name = $event"></text-field>

                            <email-field :value="user.email" :label="'Email adresa'" :error="error? error.email : ''" :required="true" @changeValue="user.email = $event"></email-field>

                            <password-field :value="user.password" :label="'Lozinka'" :error="error? error.password : ''" :required="true" @changeValue="user.password = $event"></password-field>

                            <password-field :value="user.password_confirmation" :label="'Potvrda lozinke'" :required="true" @changeValue="user.password_confirmation = $event"></password-field>

                            <select-multiple-field v-if="roles" :error="error? error.role_ids : ''" :options="roles" :labela="'Uloge'" @changeValue="user.role_ids = $event"></select-multiple-field>

                            <checkbox-field :value="user.block" :label="'Blokiran'" @changeValue="user.block = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

                    <upload-image-helper
                            :image="user.imagePath"
                            :defaultImage="'img/user-image.png'"
                            :titleImage="'korisnika'"
                            :error="error"
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              fillable: ['name', 'email', 'password', 'password_confirmation', 'image', 'role_id', 'block', 'role_ids'],
              user: {
                  role_id: 0,
              },
              roles: false,
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getRoles();
        },
        methods: {
            getRoles(){
                axios.get('api/roles/lists')
                    .then(res => {
                        this.roles = res.data.roles;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                let data = fillForm(this.fillable, this.user);
                axios.post('api/users', data)
                    .then(res => {
                        this.user = res.data.user;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/users');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.user.imagePath = image.src;
                this.user.image = image.file;
            },
        }
    }
</script>