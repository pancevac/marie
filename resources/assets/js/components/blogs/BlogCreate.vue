<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/blogs'">Kategorije članaka</router-link></li>
                            <li>Kreiraj kategoriju</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiraj kategoriju</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select-field v-if="lists" :labela="'Nad kategorija'" :options="lists" :value="null" :error="error? error.parent : ''" @changeValue="blog.parent = $event"></select-field>

                            <text-field :value="blog.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="blog.title = $event"></text-field>

                            <text-field :value="blog.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="blog.slug = $event"></text-field>

                            <text-field :value="blog.seo_title" :label="'SEO naslov'" :error="error? error.seo_title : ''" @changeValue="blog.seo_title = $event"></text-field>

                            <text-field :value="blog.seo_keywords" :label="'SEO ključne reči'" :error="error? error.seo_keywords : ''" @changeValue="blog.seo_keywords = $event"></text-field>

                            <text-field :value="blog.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="blog.order = $event"></text-field>

                            <text-area-ckeditor-field :value="blog.short" :label="'Opis'" :error="error? error.short : ''" @changeValue="blog.short = $event"></text-area-ckeditor-field>

                            <checkbox-field :value="blog.is_visible" :label="'Publikovano'" @changeValue="blog.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="blog.image"
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
              fillable: ['title', 'slug', 'short', 'seo_title', 'seo_keywords', 'order', 'parent', 'level', 'image', 'is_visible'],
              blog: {
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
            this.getList();
        },
        methods: {
            submit(){
                let data = fillForm(this.fillable, this.blog);
                axios.post('api/blogs', data)
                    .then(res => {
                        this.blog = res.data.blog;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/blogs');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.blog.imagePath = image.src;
                this.blog.image = image.file;
            },
            getList(){
                axios.get('api/blogs/lists?parent=0')
                    .then(res => {
                        this.lists = res.data.blogs;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        },
        watch: {
            'blog.title'(){
                this.blog.slug = Slug(this.blog.title);
            }
        },
    }
</script>