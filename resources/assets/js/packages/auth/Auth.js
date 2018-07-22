export default function (Vue) {
    Vue.auth = {
        setToken(token, expiration){
            localStorage.setItem('mc_token', token);
            localStorage.setItem('mc_expiration', expiration);
        },

        getToken(){
            var token = localStorage.getItem('mc_token');
            var expiration = localStorage.getItem('mc_expiration');

            if(!token || !expiration){
                return null;
            }

            if(Date.now() > parseInt(expiration)){
                this.destroyToken();
                return null;
            }else{
                return token;
            }
        },

        destroyToken(){
            localStorage.removeItem('mc_token');
            localStorage.removeItem('mc_expiration');
            localStorage.removeItem('vuex');
        },

        isAuth(){
            if(this.getToken()){
                return true;
            }else{
                return false;
            }
        }
    }

    Object.defineProperties(Vue.prototype, {
        $auth: {
            get: () => {
                return Vue.auth
            }
        }
    });
}
