<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Uloge</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <h5>Uloge</h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">ime</th>
                            <th scope="col">zaštićeno ime</th>
                            <th scope="col">publikovano</th>
                            <th>akcija</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in roles">
                            <td>{{ row.id }}</td>
                            <td>{{ row.name }}</td>
                            <td>{{ row.guard_name }}</td>
                            <td>{{ row.is_visible? 'Da' : 'Ne' }}</td>
                            <td>
                                <font-awesome-icon icon="pencil-alt" @click="editRow(row['id'])"/>
                                <font-awesome-icon icon="times" @click="deleteRow(row)" />
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                roles: {},
                paginate: {}
            }
        },
        components: {
            'paginate-helper': PaginateHelper,
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
            this.getRoles();
        },
        methods: {
            getRoles(){
                axios.get('api/roles')
                    .then(res => {
                        this.roles = res.data.roles.data;
                        this.paginate = res.data.roles;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('roles/' + id + '/edit');
            },
            deleteRow(row){
                swal({
                    title: 'Da li ste sigurni?',
                    text: "Nećete moći da povratite radnju!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#51d2b7',
                    cancelButtonColor: '#fb9678',
                    confirmButtonText: 'Da, obriši!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/roles/' + row.id)
                            .then(res => {
                                this.roles = this.roles.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Pretplatnik je obrisan.',
                                    'success'
                                );
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    }
                })
            },
            clickToLink(index){
                axios.get('api/roles?page=' + index)
                    .then(res => {
                        this.roles = res.data.roles.data;
                        this.paginate = res.data.roles;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            addRow(){
                this.$router.push('/roles/create');
            }
        }
    }
</script>