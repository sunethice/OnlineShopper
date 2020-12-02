import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import Cookies from "js-cookie";
import * as types from "./mutation-types";
import products from "../components/pages/products.vue";
import { BIconFullscreenExit } from "bootstrap-vue";

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

const state = {
    added: [],
    productList: [],
    status: "",
    token: localStorage.getItem("token") || "",
    user: {}
};

// getters
const getters = {
    allProducts: state => state.productList,
    cartProducts: state => state.added,
    loggedUser: state => state.user
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
    [types.ADD_TO_CART](state, { product_id, name, price }) {
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
        state.productList = data;
    },
    [types.AUTH_SUCCESS](state, data) {
        state.status = "success";
        state.token = data.token;
        state.user = data.user;
    },
    [types.AUTH_ERROR](state) {
        state.status = "error";
    },
    [types.AUTH_LOGOUT](state){
        localStorage.setItem("token","");
        state.token = "";
        state.user = {};
    }
};

export default new Vuex.Store({
    state,
    plugins: [
        createPersistedState({
            storage: {
                getItem: key => Cookies.get(key),
                setItem: (key, value) =>
                    Cookies.set(key, value, { expires: 3, secure: true }),
                removeItem: key => Cookies.remove(key)
            }
        })
    ],
    components: {
        products
    },
    strict: debug,
    getters,
    actions: {
        register({ commit }, user) {
            console.log(user);
            return new Promise((resolve, reject) => {
                axios({ url: "api/register", data: user, method: "POST" })
                    .then(resp => {
                        let mData = {
                            token:resp.data.token,
                            user:resp.data.user
                        }
                        // localStorage.setItem('token', token)
                        axios.defaults.headers.common["Authorization"] = mToken;

                        commit(types.AUTH_SUCCESS, mData);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit(types.AUTH_ERROR, err);
                        // storage.removeItem("token");
                        // localStorage.removeItem('token')
                        reject(err);
                    });
            });
        },
        login({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "api/login/", data: user, method: "POST" })
                    .then(resp => {
                        let mData = {
                            token:resp.data.token,
                            user:resp.data.user
                        }
                        // localStorage.setItem('token', token)
                        axios.defaults.headers.common["Authorization"] = mToken;
                        commit(types.AUTH_SUCCESS, mData);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit(types.AUTH_ERROR);
                        // storage.removeItem("token");
                        reject(err);
                    });
            });
        },
        logout() {
            return new Promise((resolve, reject) => {
                this.commit(types.AUTH_LOGOUT);
                // localStorage.removeItem('token')
                delete axios.defaults.headers.common["Authorization"];
                resolve();
            });
        },
        getProducts(context) {
            console.log("getProducts");
            axios.get("api/products/").then(response => {
                context.commit(types.LIST_PRODUCTS, response.data);
            });
        } // dispatch an action   ->    this.$store.dispatch("getProducts");
    },
    mutations
});
