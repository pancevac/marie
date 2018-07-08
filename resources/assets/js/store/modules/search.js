export default {
    namespaced: true,
    state: {

        /** search product **/
        searchProduct: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search category **/
        searchCategory: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search brand **/
        searchBrand: {
            text: '',
            page: 1,
        },

        /** search attribute **/
        searchAttribute: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search post **/
        searchPost: {
            text: '',
            list: 0,
            page: 1,
        },

        /** search client **/
        searchClient: {
            text: '',
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

        /** search attribute **/
        getSearchAttribute: state => {
            return state.searchAttribute;
        },

        /** search post **/
        getSearchPost: state => {
            return state.searchPost;
        },

        /** search client **/
        getSearchClient: state => {
            return state.searchClient;
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

        /** search attribute **/
        changeSearchAttribute: (state, data) => {
            state.searchAttribute = data;
        },
        changeSearchAttributePage: (state, data) => {
            state.searchAttribute.page = data;
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

        /** search attribute **/
        changeSearchAttribute: (context, data) => {
            context.commit('changeSearchAttribute', data);
        },
        changeSearchAttributePage: (context, data) => {
            context.commit('changeSearchAttributePage', data);
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
    },
};
