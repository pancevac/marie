<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/categories'">Kategorije</router-link></li>
                            <li>Sortiranje kategorija</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div>
                        <tree :data="data" draggable="draggable"  :indent="30">
                            <div slot-scope="{data, level, store}">
                                <template v-if="!data.isDragPlaceHolder">
                                    <b v-if="data.children &amp;&amp; data.children.length" @click="store.toggleOpen(data)">{{data.open ? '-' : '+'}}&nbsp;</b>
                                    <span>{{data.title}}</span>
                                </template>
                            </div>
                        </tree>
                        <div class="form-group">
                            <button class="btn btn-success" @click="save()">Sačuvaj</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import { DraggableTree } from 'vue-draggable-nested-tree';

    export default {
        data(){
            return {
                categories: [],
                data: [],
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'tree': DraggableTree,
        },
        created(){
            this.getCategories();
        },
        methods: {
            getCategories(){
                axios.get('api/categories/sort')
                    .then(res => {
                        this.data = res.data.categories;
                        console.log(this.data);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            updateLinks(){
                this.categories.map((category, index) => {
                    category.order = index + 1;
                })
            },
            save(){
                let data = this.order(this.data);
                axios.post('api/categories/order', {'categories': data})
                    .then(res => {
                        this.data = res.data.categories;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            order(items){
                return items.map((item) => {
                    if (item.children.length) {
                        return {
                            id: item.id,
                            title: item.title,
                            children: this.order(item.children),
                        };
                    }

                    return {
                        id: item.id,
                        title: item.title,
                    };
                });
            }
        },
    }
</script>

<style>
    .he-tree{
        border: 1px solid #ccc;
        padding: 20px;
        width: 100%;
    }
    .tree-node{
    }
    .tree-node-inner{
        padding: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
    }
    .draggable-placeholder{
    }
    .draggable-placeholder-inner{
        border: 1px dashed #0088F8;
        box-sizing: border-box;
        background: rgba(0, 136, 249, 0.09);
        color: #0088f9;
        text-align: center;
        padding: 0;
        display: flex;
        align-items: center;
    }
</style>