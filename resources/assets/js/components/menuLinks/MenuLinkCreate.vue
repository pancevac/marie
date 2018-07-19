<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                            <li>Izmena linka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena linka</h5>
                    </div>
                </div>

                <div class="col-md-4">

                    <upload-image-helper
                            :image="link.image_path"
                            :defaultImage="null"
                            :titleImage="'linka'"
                            :error="error"
                            @uploadImage="prepare($event)"
                            @removeRow="remove($event)"
                    ></upload-image-helper>

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form @submit.prevent="submit()">

                            <select-field v-if="links" :labela="'Nad link'" :options="links" :error="error? error.parent : ''" :value="null" @changeValue="link.parent = $event"></select-field>

                            <text-field :value="link.title" :label="'Naziv'" :error="error? error.title : ''" :required="true" @changeValue="link.title = $event"></text-field>

                            <text-field :value="link.link" :label="'Link'" :error="error? error.link : ''" :required="true" @changeValue="link.link = $event"></text-field>

                            <text-field :value="link.desc" :label="'Opis'" :error="error? error.desc : ''" @changeValue="link.desc = $event"></text-field>

                            <text-field :value="link.order" :label="'Redosled'" :error="error? error.order : ''" @changeValue="link.order = $event"></text-field>

                            <text-field :value="link.sufix" :label="'Sufix'" :error="error? error.sufix : ''" @changeValue="link.sufix = $event"></text-field>

                            <checkbox-field :value="link.is_visible" :label="'Publikovano'" @changeValue="link.is_visible = $event"></checkbox-field>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Kreiraj</button>
                            </div>
                        </form>

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
              fillable: ['menu_id', 'title', 'link', 'image', 'desc', 'sufix', 'order', 'parent', 'level', 'is_visible'],
              image: {},
              link: {
                  title: null,
              },
              links: false,
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
        },
        mounted(){
            this.getParentLinks();
        },
        methods: {
            getParentLinks(){
                axios.get('api/menu-links/lists')
                    .then(res => {
                        this.links = res.data.links;
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(){
                this.link.menu_id = this.$route.params.id;
                let data = fillForm(this.fillable, this.link);
                axios.post('api/menu-links', data)
                    .then(res => {
                        this.link = res.data.link;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/menu-links/' + this.$route.params.id);
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            prepare(image){
                this.link.image_path = image.src;
                this.link.image = image.file;
            },
        },
        watch: {
            'link.title'(){
                this.link.link = Slug(this.link.title);
            }
        },
    }
</script>