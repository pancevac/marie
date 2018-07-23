<template>
    <div>
        <top-bar></top-bar>
        <right-bar></right-bar>
        <left-bar></left-bar>

        <router-view></router-view>

        <footer>
            <p>Developed by Mini STUDIO Publishing Group</p>
        </footer>
    </div>
</template>

<script>
    export default {
        computed: {
            user(){
                return this.$store.getters['user/getUser'];
            }
        },
        created(){
            this.storeUser();
        },
        methods: {
            /** auth **/
            storeUser(){
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$auth.getToken();
                if(this.$store.getters['user/getUser'] == null){
                    axios.get('api/user')
                        .then(res => {
                            if(res.data.role_id < 1){
                                this.$auth.destroyToken();
                                this.$router.push('/login');
                            }else{
                                this.$store.dispatch('user/changeUser', res.data);
                            }
                        })
                        .catch(e => {
                            if(e.response.status == 401){
                                this.$auth.destroyToken();
                                this.$router.push('/login');
                            }
                        });
                }
            },
        },
    }
</script>