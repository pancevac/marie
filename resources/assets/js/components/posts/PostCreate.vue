<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                            <li>Kreiranje članka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje članka</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="post.title" :label="'Naslov'" :error="error? error.title : ''" :required="true" @changeValue="post.title = $event"></text-field>

                            <text-field :value="post.slug" :label="'Slug'" :error="error? error.slug : ''" @changeValue="post.slug = $event"></text-field>

                            <date-time-picker :label="'Publikovano od'" :value="post.publish_at" :error="error? error.publish_at : ''" @changeValue="post.publish_at = $event"></date-time-picker>

                            <text-area-field :value="post.short" :label="'Kratak opis'" :error="error? error.short : ''" :required="true" @changeValue="post.short = $event"></text-area-field>

                            <text-area-ckeditor-field :value="post.content" :label="'Opis'" :error="error? error.content : ''" :required="true" @changeValue="post.content = $event"></text-area-ckeditor-field>

                            <select-multiple-field v-if="tags" :error="error? error.tag_ids : ''" :options="tags" :labela="'Tagovi'" @changeValue="post.tag_ids = $event"></select-multiple-field>

                            <checkbox-field :value="post.is_visible" :label="'Publikovano'" @changeValue="post.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="post.image_path"
                            :defaultImage="null"
                            :titleImage="'slajdera'"
                            :error="error.image"
                            :dimensions="''"
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <div class="card" v-if="lists">
                        <div class="card-body">
                            <h3>Kategorije</h3>
                            <small class="form-text text-muted" v-if="error != null && error.blog_ids">{{ error.blog_ids[0] }}</small>
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
              fillable: ['user_id', 'title', 'slug', 'short', 'content', 'image', 'image_box', 'publish_at', 'is_visible', 'blog_ids', 'tag_ids'],
              post: {
                  title: null,
                  blog_ids: [],
                  image: '',
                  image_box: '',
                  tag_ids: [],
                  is_visible: false,
              },
              lists: false,
              tags: false,
              error: {
                  image: null,
                  image_box: null,
              },
              blog_ids: [],
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
        mounted(){
            this.getList();
            this.getTags();
        },
        methods: {
            submit(){
                this.post.user_id = this.user.id;
                let data = fillForm(this.fillable, this.post)
                axios.post('api/posts', data)
                    .then(res => {
                        this.post = res.data.post;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/posts');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.post.image_path = image.src;
                this.post.image = image.file;
            },
            prepareBox(image){
                this.post.image_box_path = image.src;
                this.post.image_box = image.file;
            },
            getList(){
                axios.get('api/blogs/tree')
                    .then(res => {
                        this.lists = res.data.blogs;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getTags(){
                axios.get('api/tags')
                    .then(res => {
                        this.tags = res.data.tags;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
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