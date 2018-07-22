<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/categories'">Kategorije</router-link></li>
                            <li>Izmeni kategoriju</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmeni kategoriju</h5>
                    </div>
                </div>

                <div class="col-sm-8" v-if="lists">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select-field v-if="lists" :labela="'Nad kategorija'" :options="lists" :value="null" :error="error? error.parent : ''" @changeValue="category.parent = $event"></select-field>

                            <text-field :value="category.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="category.title = $event"></text-field>

                            <text-field :value="category.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="category.slug = $event"></text-field>

                            <text-field :value="category.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="category.order = $event"></text-field>

                            <text-area-ckeditor-field :value="category.short" :label="'Opis'" :error="error? error.short : ''" @changeValue="category.short = $event"></text-area-ckeditor-field>

                            <checkbox-field :value="category.is_visible" :label="'Publikovano'" @changeValue="category.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">

                    <upload-image-helper
                            :image="category.image_path"
                            :defaultImage="null"
                            :titleImage="'kategorije'"
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
              fillable: ['title', 'slug', 'short', 'order', 'parent', 'level', 'image', 'is_visible'],
              category: {
                  title: null,
                  parent: 0,
              },
              lists: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getCategory();
        },
        methods: {
            getCategory(){
                axios.get('api/categories/' + this.$route.params.id)
                    .then(res => {
                        this.lists = res.data.categories;
                        this.category = res.data.category;
                        this.category.image_path = this.category.image;
                        this.category.image = '';
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                let data = fillForm(this.fillable, this.category, 'PUT');
                axios.post('api/categories/' + this.category.id, data)
                    .then(res => {
                        this.category = res.data.category;
                        this.category.image_path = this.category.image;
                        this.category.image = '';
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.category.image_path = image.src;
                this.category.image = image.file;
            },
        },
        watch: {
            'category.title'(){
                this.category.slug = Slug(this.category.title);
            }
        },
    }
</script>