<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/banners'">Baneri</router-link></li>
                            <li>Kreiranje banera</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje banera</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="banner.title" :label="'Naziv'" :error="error? error.title : ''" :required="true" @changeValue="banner.title = $event"></text-field>

                            <text-field :value="banner.link" :label="'Link'" :error="error? error.link : ''" @changeValue="banner.link = $event"></text-field>

                            <text-field :value="banner.width" :label="'Širina'" :error="error? error.width : ''" @changeValue="banner.width = $event"></text-field>

                            <text-field :value="banner.height" :label="'Visina'" :error="error? error.height : ''" @changeValue="banner.height = $event"></text-field>

                            <checkbox-field :value="banner.is_visible" :label="'Vidljivo'" @changeValue="banner.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="banner.image_path"
                            :defaultImage="null"
                            :titleImage="'banera'"
                            :error="error"
                            :dimensions="''"
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
              fillable: ['title', 'link', 'width', 'height', 'image', 'is_visible'],
              banner: {
                  title: null,
                  is_visible: false,
              },
              error: null,
          }
        },
        computed: {
            user(){
                return this.$store.getters['user/getUser'];
            },
            admin(){
                return this.$store.getters['user/isAdmin'];
            },
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        methods: {
            submit(){
                let data = fillForm(this.fillable, this.banner)
                axios.post('api/banners', data)
                    .then(res => {
                        this.banner = res.data.banner;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/banners');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.banner.image_path = image.src;
                this.banner.image = image.file;
            },
        },
    }
</script>