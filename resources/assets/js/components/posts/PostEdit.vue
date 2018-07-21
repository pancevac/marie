<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                            <li>Izmena članka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena članka</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <h5>Gallery images</h5>
                        <hr>
                        <div id="gallery" v-if="gallery">
                            <div v-for="photo in gallery" class="photo">
                                <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                <img :src="photo.tmb" class="img-thumbnail" alt="post.title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card" v-if="post">

                        <upload-image-helper
                                :image="post.image_path"
                                :defaultImage="null"
                                :titleImage="'slajdera'"
                                :error="error.image"
                                :dimensions="'800x450 px'"
                                @uploadImage="prepare($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                        <upload-image-helper
                                :image="post.image_box_path"
                                :defaultImage="null"
                                :titleImage="'članka'"
                                :error="error.image_box"
                                :dimensions="'600x600 px'"
                                @uploadImage="prepareBox($event)"
                                @removeRow="remove($event)"
                        ></upload-image-helper>

                        <div class="card" v-if="lists">
                            <div class="card-body">
                                <h3>Kategorije</h3>
                                <ul class="no-parent">
                                    <li v-for="blog in lists" :id="`list_${blog.id}`">
                                        <label><input type="checkbox" v-model="post.blog_ids" :value="blog.id"> {{ blog.title }}</label>
                                        <ul class="blogs" v-if="blog.children.length > 0">
                                            <li v-for="sub_blog in blog.children" :id="`list_${sub_blog.id}`">
                                                <label><input type="checkbox" v-model="post.blog_ids" :value="sub_blog.id"> {{ sub_blog.title }}</label>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div><!-- .card -->

                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="tab-content" id="myTabContent" v-if="lists">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit()">

                                    <date-time-picker :labela="'Publikovano od'" :value="post.publish_at" :error="error? error.publish_at : ''" @changeValue="post.publish_at = $event"></date-time-picker>

                                    <text-field :value="post.title" :label="'Naslov'" :error="error? error.title : ''" :required="true" @changeValue="post.title = $event"></text-field>

                                    <text-field :value="post.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="post.slug = $event"></text-field>

                                    <text-area-field :value="post.short" :label="'Kratak opis'" :error="error? error.short : ''" :required="true" @changeValue="post.short = $event"></text-area-field>

                                    <text-area-ckeditor-field :value="post.body" :label="'Opis'" :error="error? error.body : ''" :required="true" @changeValue="post.body = $event"></text-area-ckeditor-field>

                                    <select-multiple-field :options="tags" :error="error? error.tag_ids : ''" :value="post.tag_ids" @changeValue="post.tag_ids = $event"></select-multiple-field>

                                    <checkbox-field :value="post.is_visible" :label="'Publikovano'" @changeValue="post.is_visible = $event"></checkbox-field>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni</button>
                                    </div>
                                </form>
                            </div><!-- #srb -->
                        </div>
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
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';

    export default {
        data(){
            return {
                fillable: ['user_id', 'title', 'slug', 'short', 'body', 'image', 'image_box', 'publish_at', 'is_visible', 'blog_ids', 'tag_ids'],
                selected: {},
                post: false,
                error: {
                    image: false,
                    image_box: false,
                },
                lists: false,
                gallery: {},
                tags: false,
                dropzoneOptions: {
                    url: 'api/posts/' + this.$route.params.id + '/gallery',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    headers: { "Authorization": "Bearer " + this.$auth.getToken() }
                },
            }
        },
        computed: {
            post_id(){
                return this.post.id;
            },
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
            'vue-dropzone': vue2Dropzone,
        },
        mounted(){
            this.getPost();
        },
        methods: {
            getPost(){
                axios.get('api/posts/' + this.$route.params.id)
                    .then(res => {
                        //this.gallery = res.data.photos;

                        this.post = res.data.post;
                        this.post.image_path = this.post.image;
                        this.post.image = null;
                        this.post.image_box_path = this.post.image_box;
                        this.post.image_box = null;

                        this.post.blog_ids = res.data.blog_ids;
                        this.post.tag_ids = res.data.tag_ids;

                        this.lists = res.data.blogs;
                        this.tags = res.data.tags;

                        this.trigger = true;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                this.post.user_id = this.user.id;
                let data = fillForm(this.fillable, this.post, 'PUT');
                axios.post('api/posts/' + this.post.id, data)
                    .then(res => {
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
            deletePhoto(photo){
                axios.post('api/galleries/' + photo.id + '/destroy')
                    .then(res => {
                        this.gallery = this.gallery.filter(function (item) {
                            return photo.id != item.id;
                        });
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
            showSuccess(){
                this.getGallery();
            },
            prepare(image){
                this.post.image_path = image.src;
                this.post.image = image.file;
            },
            prepareBox(image){
                this.post.image_box_path = image.src;
                this.post.image_box = image.file;
            },
        },
        watch: {
            'post.title'(){
                this.post.slug = Slug(this.post.title);
            },
        },
    }
</script>

<style scoped>

    ul.blogs{
        list-style: none;
    }

    ul.no-parent{
        padding-left: 0;
        list-style: none;
    }

    ul.blogs li {
        margin-top: 1em;
    }

    label {
        font-weight: bold;
    }

    ul.blogs li input[type="checkbox"]{
        margin-right: 5px;
    }
</style>