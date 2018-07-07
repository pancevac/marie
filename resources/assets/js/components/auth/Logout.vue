<template>

</template>

<script>
    export default {
        created(){
            this.$auth.destroyToken();
            this.$router.push('/login');
        }
    }
</script>