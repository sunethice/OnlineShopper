import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from 'vuex-persistedstate';
import Cookies from 'js-cookie';
import * as types from "./mutation-types";
import products from '../components/pages/products.vue';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

const state = {
    added: [],
    productList: [],
    user:null
};

// getters
const getters = {
    allProducts: state => state.productList,
    cartProducts: state => state.added
};

// actions
// const actions = {
//     addToCart({ commit }, product) {
//         commit(types.ADD_TO_CART, {
//             id: product.id
//         });
//     },
//     ListProducts({ commit}){
//         commit(types.LIST_PRODUCTS)
//         //axios.get("api/products/").then(response => this.products = response.data)
//     }
// };

const mutations = {
    [types.ADD_TO_CART](state, { product_id,name, price }) {
        const record = state.added.find(p => p.product_id === product_id);
        if (!record) {
            state.added.push({
                product_id,
                name,
                price,
                quantity: 1
            });
        } else {
            record.quantity++;
        }
    },
    [types.LIST_PRODUCTS](state, data) {
        state.productList = data
    }
};

export default new Vuex.Store({
    state,
    plugins: [createPersistedState({
        storage: {
          getItem: key => Cookies.get(key),
          setItem: (key, value) => Cookies.set(key, value, { expires: 3, secure: true }),
          removeItem: key => Cookies.remove(key)
        }
    })],
    components: {
        products
    },
    strict: debug,
    getters,
    actions: {
        getProducts(context) {
            console.log('getProducts');
            axios.get("api/products/")
            .then(response => {
                context.commit(types.LIST_PRODUCTS, response.data)
            })
        } // dispatch an action   ->    this.$store.dispatch("getProducts");
    },
    mutations
});
