export default {
    namespaced: true,
    state: {
        /** auth **/
        user: null,

        admin: false,
    },
    getters: {
        /** auth **/
        getUser: state => {
            return state.user;
        },

        isAdmin: state => {
            return state.admin;
        },
    },
    mutations: {
        /** auth **/
        changeUser: (state, callback) => {
            state.user = callback;
            if(state.user.role_id == 2){
                state.admin = true;
            }
        },

        /** auth image **/
        changeUserImage: (state, callback) => {
            state.user.image = callback;
        },
    },
    actions: {
        /** auth **/
        changeUser: (context, callback) => {
            context.commit('changeUser', callback);
        },
        /** auth image **/
        changeUserImage: (context, callback) => {
            context.commit('changeUserImage', callback);
        },
    },
};
