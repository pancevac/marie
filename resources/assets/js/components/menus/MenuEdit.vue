<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                            <li>Izmena menija</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena menija</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card" v-if="menu">
                        <form @submit.prevent="submit()">

                            <text-field :value="menu.title" :label="'Naziv'" :error="error? error.title : ''" @changeValue="menu.title = $event"></text-field>

                            <text-field :value="menu.prefix" :label="'Prefix'" :error="error? error.prefix : ''" @changeValue="menu.prefix = $event"></text-field>

                            <text-field :value="menu.sufix" :label="'Sufix'" :error="error? error.sufix : ''" @changeValue="menu.sufix = $event"></text-field>

                            <text-field :value="menu.class" :label="'Class'" :error="error? error.class : ''" @changeValue="menu.class = $event"></text-field>

                            <checkbox-field :value="menu.is_visible" :label="'Publikovano'" @changeValue="menu.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!--
                    <upload-image-helper
                            :image="menu.image"
                            :defaultImage="null"
                            :titleImage="'menu'"
                            :error="error"
                            @uploadImage="upload($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>
                    -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              fillable: ['title', 'slug', 'prefix', 'sufix', 'class', 'is_visible'],
              menu: false,
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
        },
        mounted(){
            this.getMenu();
        },
        methods: {
            getMenu(){
                axios.get('api/menus/' + this.$route.params.id)
                    .then(res => {
                        this.menu = res.data.menu;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                let data = fillForm(this.fillable, this.menu, 'PUT');
                axios.post('api/menus/' + this.menu.id, data)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            }
        }
    }
</script>