<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/brands'">Brendovi</router-link></li>
                            <li>Kreiraj brend</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiraj brend</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="brand.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="brand.title = $event"></text-field>

                            <text-field :value="brand.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="brand.slug = $event"></text-field>

                            <text-area-field :value="brand.short" :label="'Kratak opis'" :error="error? error.short : ''" @changeValue="brand.short = $event"></text-area-field>

                            <text-area-ckeditor-field :value="brand.content" :label="'Opis'" :error="error? error.content : ''" @changeValue="brand.content = $event"></text-area-ckeditor-field>

                            <text-field :value="brand.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="brand.order = $event"></text-field>

                            <checkbox-field :value="brand.is_visible" :label="'Publikovano'" @changeValue="brand.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

                    <upload-image-helper
                            :image="brand.image_path"
                            :defaultImage="null"
                            :titleImage="'brenda'"
                            :error="error"
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <upload-image-helper
                            :image="brand.logo_path"
                            :defaultImage="null"
                            :titleImage="'logoa'"
                            :error="error"
                            @uploadImage="prepareLogo($event)"
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
              fillable: ['title', 'slug', 'short', 'content', 'order', 'image', 'logo', 'is_visible'],
              brand: {
                  title: null,
              },
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        methods: {
            submit(){
                let data = fillForm(this.fillable, this.brand);
                axios.post('api/brands', data)
                    .then(res => {
                        this.brand = res.data.brand;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/brands');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.brand.image_path = image.src;
                this.brand.image = image.file;
            },
            prepareLogo(image){
                this.brand.logo_path = image.src;
                this.brand.logo = image.file;
            },
        },
        watch: {
            'brand.title'(){
                this.brand.slug = Slug(this.brand.title);
            }
        },
    }
</script>