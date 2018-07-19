<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/users'">Korisnici</router-link></li>
                            <li>Izmena lozinke</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena lozinke</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <password-field :value="user.oldpassword" :label="'Stara lozinka'" :error="error? error.oldpassword : ''" :required="true" @changeValue="user.oldpassword = $event"></password-field>

                            <password-field :value="user.password" :label="'Nova lozinka'" :error="error? error.password : ''" :required="true" @changeValue="user.password = $event"></password-field>

                            <password-field :value="user.password_confirmation" :label="'Potvrda nove lozinke'" :error="error? error.password_confirmation : ''" :required="true" @changeValue="user.password_confirmation = $event"></password-field>

                            <div class="form-group">
                                <button class="btn btn-primary">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="user.image_path"
                            :defaultImage="'img/user-image.png'"
                            :titleImage="'korisnika'"
                            :error="error.image"
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
              fillable: ['oldpassword', 'password', 'password_confirmation', 'image'],
              error: {
                  image: null,
              }
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        computed: {
            user(){
                return this.$store.getters['user/getUser'];
            },
            'user.imagePath'(){
                return this.$store.getters['user/getUser'].image;
            }
        },
        methods: {
            submit(){
                let data = fillForm(this.fillable, this.user);
                axios.post('api/users/' + this.user.id + '/change-password', data)
                    .then(res => {
                        this.$store.dispatch('user/changeUserImage', res.data.user.image);
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.user.image_path = image.src;
                this.user.image = image.file;
            },
        }
    }
</script>