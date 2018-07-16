export default {
    namespaced: true,
    state: {

        /** search product **/
        searchProduct: {
            title: '',
            list: 0,
            page: 1,
        },

        /** search category **/
        searchCategory: {
            title: '',
            list: 0,
            page: 1,
        },

        /** search brand **/
        searchBrand: {
            title: '',
            page: 1,
        },

        /** search post **/
        searchPost: {
            title: '',
            list: 0,
            page: 1,
        },

        /** search tag **/
        searchTag: {
            title: '',
            list: 0,
            page: 1,
        },
    },
    getters: {

        /** search product **/
        getSearchProduct: state => {
            return state.searchProduct;
        },

        /** search category **/
        getSearchCategory: state => {
            return state.searchCategory;
        },

        /** search brand **/
        getSearchBrand: state => {
            return state.searchBrand;
        },

        /** search post **/
        getSearchPost: state => {
            return state.searchPost;
        },

        /** search client **/
        getSearchClient: state => {
            return state.searchClient;
        },

        /** search tag **/
        getSearchTag: state => {
            return state.searchTag;
        },
    },
    mutations: {
        /** search product **/
        changeSearchProduct: (state, data) => {
            state.searchProduct = data;
        },
        changeSearchProductPage: (state, data) => {
            state.searchProduct.page = data;
        },

        /** search category **/
        changeSearchCategory: (state, data) => {
            state.searchCategory = data;
        },
        changeSearchCategoryPage: (state, data) => {
            state.searchCategory.page = data;
        },

        /** search brand **/
        changeSearchBrand: (state, data) => {
            state.searchBrand = data;
        },
        changeSearchBrandPage: (state, data) => {
            state.searchBrand.page = data;
        },

        /** search post **/
        changeSearchPost: (state, data) => {
            state.searchPost = data;
        },
        changeSearchPostPage: (state, data) => {
            state.searchPost.page = data;
        },

        /** search client **/
        changeSearchClient: (state, data) => {
            state.searchClient = data;
        },
        changeSearchClientPage: (state, data) => {
            state.searchClient.page = data;
        },

        /** search tag **/
        changeSearchTag: (state, data) => {
            state.searchTag = data;
        },
        changeSearchTagPage: (state, data) => {
            state.searchTag.page = data;
        },
    },
    actions: {
        /** search products **/
        changeSearchProduct: (context, data) => {
            context.commit('changeSearchProduct', data);
        },
        changeSearchProductPage: (context, data) => {
            context.commit('changeSearchProductPage', data);
        },

        /** search category **/
        changeSearchCategory: (context, data) => {
            context.commit('changeSearchCategory', data);
        },
        changeSearchCategoryPage: (context, data) => {
            context.commit('changeSearchCategoryPage', data);
        },

        /** search brand **/
        changeSearchBrand: (context, data) => {
            context.commit('changeSearchBrand', data);
        },
        changeSearchBrandPage: (context, data) => {
            context.commit('changeSearchBrandPage', data);
        },

        /** search post **/
        changeSearchPost: (context, data) => {
            context.commit('changeSearchPost', data);
        },
        changeSearchPostPage: (context, data) => {
            context.commit('changeSearchPostPage', data);
        },

        /** search client **/
        changeSearchClient: (context, data) => {
            context.commit('changeSearchClient', data);
        },
        changeSearchClientPage: (context, data) => {
            context.commit('changeSearchClientPage', data);
        },

        /** search tag **/
        changeSearchTag: (context, data) => {
            context.commit('changeSearchTag', data);
        },
        changeSearchTagPage: (context, data) => {
            context.commit('changeSearchTagPage', data);
        },
    },
};
