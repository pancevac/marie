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
    },
    actions: {
        /** auth **/
        changeUser: (context, callback) => {
            context.commit('changeUser', callback);
        },
    },
};
