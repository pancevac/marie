<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/products'">Proizvodi</router-link></li>
                            <li>Kreiranje proizvoda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Kreiranje proizvoda</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <text-field :value="product.title" :label="'Naslov'" :error="error? error.title : ''" :required="true" @changeValue="product.title = $event"></text-field>

                            <text-field :value="product.slug" :label="'Slug'" :error="error? error.slug : ''" :required="true" @changeValue="product.slug = $event"></text-field>

                            <text-field :value="product.link" :label="'Link'" :error="error? error.link : ''" :required="true" @changeValue="product.link = $event"></text-field>

                            <select-field v-if="brands" :error="error? error.brand_id : ''" :options="brands" :labela="'Brend'" @changeValue="product.brand_id = $event"></select-field>

                            <select-field v-if="genders" :error="error? error.gender : ''" :options="genders" :labela="'Pol'" @changeValue="product.gender = $event"></select-field>

                            <date-time-picker :label="'Publikovano od'" :value="product.publish_at" :error="error? error.publish_at : ''" @changeValue="product.publish_at = $event"></date-time-picker>

                            <text-area-field :value="product.short" :label="'Kratak opis'" :error="error? error.short : ''" :required="true" @changeValue="product.short = $event"></text-area-field>

                            <text-area-ckeditor-field :value="product.content" :label="'Opis'" :error="error? error.content : ''" :required="true" @changeValue="product.content = $event"></text-area-ckeditor-field>

                            <text-field :value="product.price" :label="'Cena'" :error="error? error.price : ''" :required="true" @changeValue="product.price = $event"></text-field>

                            <text-field :value="product.outlet_price" :label="'Outlet cena'" :error="error? error.outlet_price : ''" @changeValue="product.outlet_price = $event"></text-field>

                            <checkbox-field :value="product.is_visible" :label="'Publikovano'" @changeValue="product.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="product.image_path"
                            :defaultImage="null"
                            :titleImage="'slajdera'"
                            :error="error.image"
                            :dimensions="'800x450 px'"
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                    <div class="card" v-if="categories">
                        <div class="card-body">
                            <h3>Kategorije</h3>
                            <ul class="no-parent">
                                <li v-for="category in categories" :id="`list_${category.id}`">
                                    <label><input type="checkbox" v-model="product.category_ids" :value="category.id"> {{ category.title }}</label>
                                    <ul class="blogs" v-if="category.children.length > 0">
                                        <li v-for="sub_category in category.children" :id="`list_${sub_category.id}`">
                                            <label><input type="checkbox" v-model="product.category_ids" :value="sub_category.id"> {{ sub_category.title }}</label>
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
              fillable: ['user_id', 'brand_id', 'title', 'slug', 'short', 'content', 'image', 'link', 'gender', 'price', 'outlet_price', 'publish_at', 'is_visible', 'categories_ids'],
              product: {
                  title: null,
                  categories_ids: [],
                  image: '',
                  is_visible: false,
              },
              categories: false,
              error: {
                  image: null,
              },
              category_ids: [],
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
            this.getCategories();
        },
        methods: {
            submit(){
                this.product.user_id = this.user.id;
                let data = fillForm(this.fillable, this.product)
                axios.post('api/products', data)
                    .then(res => {
                        this.product = res.data.product;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/products');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.product.image_path = image.src;
                this.product.image = image.file;
            },
            getCategories(){
                axios.get('api/categories/tree')
                    .then(res => {
                        this.categories = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
        },
        watch: {
            'product.title'(){
                this.product.slug = Slug(this.product.title);
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