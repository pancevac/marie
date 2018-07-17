<template>
    <div id="leftMenu" :class="{ 'hide': hideLeftBar }" v-if="user">
        <div class="logo-holder">
            <div class="logo">
                <a :href="domain" target="_blank">
                    <img :src="domain + 'img/logo.png'" alt="Fusion Tables">
                </a>
            </div>
        </div>
        <ul>
            <li>
                <font-awesome-icon icon="home" />
                <router-link tag="a" :to="'/home'">Početna</router-link>
            </li>
            <li :class="{ 'active': showSettingsItemActive }" :style="{ 'display': showSettingsItem ? 'block' : 'none' }"  v-if="admin">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowSettingsItemActive()">Podešavanja</a>
                <font-awesome-icon icon="cogs"/>
                <ul>
                    <li><router-link tag="a" :to="'/settings/1/edit'">SEO</router-link></li>
                    <li><router-link tag="a" :to="'/themes'">Teme</router-link></li>
                    <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                </ul>
            </li>
            <li v-if="admin">
                <font-awesome-icon icon="users" />
                <router-link tag="a" :to="'/users'">Korisnici</router-link>
            </li>
            <li :class="{ 'active': showProductsItemActive }" :style="{ 'display': showProductsItem ? 'block' : 'none' }">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowProductsItemActive()">Prodavnica</a>
                <font-awesome-icon icon="shopping-cart" />
                <ul>
                    <li><router-link tag="a" :to="'/products'">Proizvodi</router-link></li>
                    <template v-if="admin">
                        <li><router-link tag="a" :to="'/categories'">Kategorije</router-link></li>
                        <li><router-link tag="a" :to="'/brands'">Brendovi</router-link></li>
                        <li><router-link tag="a" :to="'/collections'">Kolekcije</router-link></li>
                        <li><router-link tag="a" :to="'/properties'">Osobine</router-link></li>
                        <li><router-link tag="a" :to="'/attributes'">Atributi</router-link></li>
                    </template>
                </ul>
            </li>
            <li :class="{ 'active': showOrdersItemActive }" :style="{ 'display': showOrdersItem ? 'block' : 'none' }" v-if="admin">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowOrdersItemActive()">Narudžbine</a>
                <font-awesome-icon icon="shopping-basket" />
                <ul>
                    <li><router-link tag="a" :to="'/shopping-carts'">Narudžbine</router-link></li>
                </ul>
            </li>
            <li :class="{ 'active': showPostsItemActive }" :style="{ 'display': showPostsItem ? 'block' : 'none' }" v-if="admin">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowPostsItemActive()">Članci</a>
                <font-awesome-icon icon="paste" />
                <ul>
                    <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                    <li><router-link tag="a" :to="'/blogs'">Kategorije</router-link></li>
                </ul>
            </li>
            <li v-if="admin">
                <font-awesome-icon icon="images" />
                <a :href="domain + 'filemanager/show'" target="_blank">File manager</a>
            </li>
            <li v-if="admin">
                <font-awesome-icon icon="tags" />
                <router-link tag="a" :to="'/tags'">Tagovi</router-link>
            </li>
            <li :class="{ 'active': showNewslettersItemActive }" :style="{ 'display': showNewslettersItem ? 'block' : 'none' }" v-if="admin">
                <font-awesome-icon icon="angle-right" />
                <a href="#" @click="changeShowNewslettersItemActive()">Newsletteri</a>
                <font-awesome-icon icon="envelope" />
                <ul>
                    <li><a href="#">Newsletteri</a></li>
                    <li><router-link tag="a" :to="'/subscribers'">Pretplatnici</router-link></li>
                    <li><router-link tag="a" :to="'/banners'">Banneri</router-link></li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                domain: domain,
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon
        },
        computed: {
            /** auth **/
            user(){
                return this.$store.getters['user/getUser'];
            },

            admin(){
                return this.$store.getters['user/isAdmin'];
            },

            /** nav **/
            hideLeftBar(){
                return this.$store.getters['nav/getHideLeftBar'];
            },

            /** settings **/
            showSettingsItem(){
                return this.$store.getters['nav/getShowSettingsItem'];
            },
            showSettingsItemActive(){
                return this.$store.getters['nav/getSettingsItemActive'];
            },

            /** users **/
            showUsersItem(){
                return this.$store.getters['nav/getShowUsersItem'];
            },
            showUsersItemActive(){
                return this.$store.getters['nav/getUsersItemActive'];
            },

            /** posts **/
            showPostsItem(){
                return this.$store.getters['nav/getShowPostsItem'];
            },
            showPostsItemActive(){
                return this.$store.getters['nav/getPostsItemActive'];
            },

            /** products **/
            showProductsItem(){
                return this.$store.getters['nav/getShowProductsItem'];
            },
            showProductsItemActive(){
                return this.$store.getters['nav/getProductsItemActive'];
            },

            /** newsletters **/
            showNewslettersItem(){
                return this.$store.getters['nav/getShowNewslettersItem'];
            },
            showNewslettersItemActive(){
                return this.$store.getters['nav/getNewslettersItemActive'];
            },

            /** templates **/
            showTemplatesItem(){
                return this.$store.getters['nav/getShowTemplatesItem'];
            },
            showTemplatesItemActive(){
                return this.$store.getters['nav/getTemplatesItemActive'];
            },

            /** orders **/
            showOrdersItem(){
                return this.$store.getters['nav/getShowOrdersItem'];
            },
            showOrdersItemActive(){
                return this.$store.getters['nav/getOrdersItemActive'];
            },
        },
        methods: {
            /** settings **/
            changeShowSettingsItemActive(){
                this.$store.dispatch('nav/changeSettingsItemActive');
            },

            /** users **/
            changeShowUsersItemActive(){
                this.$store.dispatch('nav/changeUsersItemActive');
            },

            /** posts **/
            changeShowPostsItemActive(){
                this.$store.dispatch('nav/changePostsItemActive');
            },

            /** products **/
            changeShowProductsItemActive(){
                this.$store.dispatch('nav/changeProductsItemActive');
            },

            /** products **/
            changeShowNewslettersItemActive(){
                this.$store.dispatch('nav/changeNewslettersItemActive');
            },

            /** galleries **/
            changeShowTemplatesItemActive(){
                this.$store.dispatch('nav/changeTemplatesItemActive');
            },

            /** orders **/
            changeShowOrdersItemActive(){
                this.$store.dispatch('nav/changeOrdersItemActive');
            },
        }
    }
</script>