<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                            <li>Galrija članka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Članak: {{ post.title }}</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <h5>Galerija slika</h5>
                        <hr>
                        <div id="gallery" v-if="post && post.gallery" v-for="photo in post.gallery">

                            <div class="col-sm-2">
                                <div class="photo">
                                    <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                    <img :src="photo.tmb" class="img-thumbnail" alt="post.title">
                                </div>
                            </div>
                            <div class="col-sm-10">

                                <text-field :value="photo.title" :label="'Naslov'" :error="error? error.title : ''" @changeValue="photo.title = $event"></text-field>

                                <text-area-field :value="photo.desc" :label="'Opis'" :error="error? error.desc : ''" @changeValue="photo.desc = $event"></text-area-field>

                            </div>

                        </div>

                        <hr>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" @click="submit()">izmeni</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';

    export default {
        data(){
            return {
                post: false,
                error: {
                    image: false,
                    image_box: false,
                },
                dropzoneOptions: {
                    url: 'api/galleries/' + this.$route.params.id,
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
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'vue-dropzone': vue2Dropzone,
        },
        mounted(){
            this.getPost();
        },
        methods: {
            getPost(){
                axios.get('api/galleries/' + this.$route.params.id)
                    .then(res => {
                        this.post = res.data.post;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            deletePhoto(photo){
                axios.post('api/galleries/' + photo.id + '/destroy')
                    .then(res => {
                        this.post.gallery = this.post.gallery.filter(function (item) {
                            return photo.id != item.id;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            showSuccess(){
                this.getPost();
            },
            submit(){
                axios.post('api/galleries/' + this.post.id + '/serialize', { gallery: this.post.gallery})
                    .then(res => {
                        this.post = res.data.post;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        },
    }
</script>

<style scoped>
    .photo{
        width: 120px !important;
        height: auto;
    }
</style>