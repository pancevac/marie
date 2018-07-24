<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/roles'">Uloge</router-link></li>
                            <li>Dozvole</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <h5>Uloga: <b>{{ role.name }}</b></h5>
                        <font-awesome-icon icon="plus" @click="addRow()" class="new-link-add" />
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Dozvola</th>
                            <th scope="col">Kreiranje</th>
                            <th scope="col">Izmena</th>
                            <th scope="col">Brisanje</th>
                        </tr>
                        </thead>
                        <tbody v-if="permission_ids">
                        <tr v-for="row in permission_groups">
                            <td>{{ row.name }}</td>
                            <td v-for="permission in row.permission">
                                {{ permission.name }}
                                <input type="checkbox" v-model="permission_ids" :value="permission.id">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" @click="submit()">Izmeni</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                role: {},
                permission_ids: [],
                permission_groups: {},
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
            this.getPermissionGroups();
        },
        methods: {
            getPermissionGroups(){
                axios.get('api/permission-groups/lists?role=' + this.$route.params.id)
                    .then(res => {
                        this.role = res.data.role;
                        this.permission_ids = res.data.permission_ids;
                        this.permission_groups = res.data.permission_groups;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            submit(){
                axios.post('api/roles/' + this.$route.params.id + '/permissions', {'permission_ids': this.permission_ids})
                    .then(res => {
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
        },
    }
</script>