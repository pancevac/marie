<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Proizvodi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <search-helper :lists="categories" :search="searchProduct" :enableList="true" @updateSearch="search($event)"></search-helper>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Članci</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">naslov</th>
                                <th scope="col">brend</th>
                                <th scope="col">vidljivo</th>
                                <th scope="col">vidljivo od</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in products">
                                <td>{{ row.id }}</td>
                                <td>{{ row.title }}</td>
                                <td>{{ row.brand.title }}</td>
                                <td>{{ row.is_visible? 'Da' : 'Ne' }}</td>
                                <td>{{ row.published_at }}</td>
                                <td>
                                    <font-awesome-icon icon="eye" @click="previewRow(row)" />
                                    <router-link tag="a" :to="'products/' + row['id'] + '/edit'" class="edit-link"><font-awesome-icon icon="pencil-alt"/></router-link>
                                    <font-awesome-icon icon="times" @click="deleteRow(row)" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <paginate-helper :paginate="paginate" @clickLink="clickToLink($event)"></paginate-helper>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PaginateHelper from '../helper/PaginateHelper.vue';
    import SearchHelper from '../helper/SearchHelper.vue';
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                products: {},
                paginate: {},
                categories: {},
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'search-helper': SearchHelper,
            'font-awesome-icon': FontAwesomeIcon,
        },
        computed: {
            searchProduct(){
                return this.$store.getters['search/getSearchProduct'] || false;
            },
        },
        mounted(){
            this.getCategories();
        },
        methods: {
            getCategories(){
                axios.get('api/categories/lists?parent=1')
                    .then(res => {
                        this.categories = res.data.lists;
                        this.getProducts();
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            getProducts(){
                this.$store.dispatch('search/changeSearchProductPage', 1);
                axios.post('api/products/search', this.searchProduct)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                        console.log(this.products);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('products/' + id + '/edit');
            },
            deleteRow(row){
                swal({
                    title: 'Da li ste sigurni?',
                    text: "Nećete moći da povratite radnju!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#51d2b7',
                    cancelButtonColor: '#fb9678',
                    confirmButtonText: 'Da, obriši ga!',
                    cancelButtonText: 'Odustani'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/products/' + row.id)
                            .then(res => {
                                this.products = this.products.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Proizvod je uspešno obrisan.',
                                    'success'
                                );
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    }
                });
            },
            clickToLink(index){
                this.$store.dispatch('search/changeSearchProductPage', index);
                axios.post('api/products/search', this.searchProduct)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            search(value){
                this.$store.dispatch('search/changeSearchProduct', value);
                this.$store.dispatch('search/changeSearchProductPage', 1);
                axios.post('api/products/search', this.searchProduct)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.paginate = res.data.products;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/products/create');
            },
            previewRow(row){
                window.open(row.link, '_blank');
            },
        },
    }
</script>