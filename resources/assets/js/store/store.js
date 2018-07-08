import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";
import user from './modules/user';
import search from './modules/search';
import nav from './modules/nav';

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        user,
        search,
        nav,
    },

    plugins: [ createPersistedState()],
});