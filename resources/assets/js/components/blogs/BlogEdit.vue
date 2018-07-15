<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/blogs'">Kategorije članaka</router-link></li>
                            <li>Izmena kategorije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela" v-if="blog">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena kategorije</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">

                        <upload-image-helper
                                :image="blog.imagePath"
                                :defaultImage="null"
                                :titleImage="'kategorije'"
                                :error="error"
                                @uploadImage="prepare($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select-field v-if="lists" :labela="'Nad kategorija'" :options="lists" :value="blog.parent_blog" :error="error? error.parent : ''" @changeValue="blog.parent = $event"></select-field>

                            <text-field :value="blog.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="blog.title = $event"></text-field>

                            <text-field :value="blog.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="blog.slug = $event"></text-field>

                            <text-field :value="blog.seo_title" :label="'SEO naslov'" :error="error? error.seo_title : ''" @changeValue="blog.seo_title = $event"></text-field>

                            <text-field :value="blog.seo_keywords" :label="'SEO ključne reči'" :error="error? error.seo_keywords : ''" @changeValue="blog.seo_keywords = $event"></text-field>

                            <text-area-ckeditor-field :value="blog.short" :label="'Opis'" :error="error? error.short : ''" @changeValue="blog.short = $event"></text-area-ckeditor-field>

                            <checkbox-field :value="blog.is_visible" :label="'Publikovano'" @changeValue="blog.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
                            </div>
                        </form>
                    </div>
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
              fillable: ['title', 'slug', 'short', 'seo_title', 'seo_keywords', 'order', 'parent', 'level', 'image', 'is_visible'],
              blog: false,
              error: null,
              lists: false,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getBlog();
        },
        methods: {
            getBlog(){
                axios.get('api/blogs/' + this.$route.params.id)
                    .then(res => {
                        this.lists = res.data.lists;
                        this.blog = res.data.blog;
                        this.blog.imagePath = this.blog.image;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                let data = fillForm(this.fillable, this.blog, 'PUT');
                axios.post('api/blogs/' + this.blog.id, data)
                    .then(res => {
                        this.blog = res.data.blog;
                        this.blog.imagePath = this.blog.image;
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
                this.blog.imagePath = image.src;
                this.blog.image = image.file;
            },
        },
        watch: {
            'blog.title'(){
                this.blog.slug = Slug(this.blog.title);
            }
        },
    }
</script>