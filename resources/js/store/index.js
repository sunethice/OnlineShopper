import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import Cookies from "js-cookie";
import * as types from "./mutation-types";
import products from "../components/pages/products.vue";

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
    loggedUser: state => state.user,
    accessToken: state => state.token
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
    [types.ADD_TO_CART](state, { product_id, product_name, price }) {
        const record = state.added.find(p => p.product_id === product_id);
        if (!record) {
            state.added.push({
                product_id,
                product_name,
                price,
                quantity: 1
            });
        } else {
            record.quantity++;
        }
    },
    [types.REMOVE_FROM_CART](state, { product_id }) {
        const record = state.added.find(p => p.product_id === product_id);
        if (record) {
            record.quantity--;
            if (record.quantity === 0) {
                state.added.splice(state.added.indexOf(record), 1);
            }
        }
    },
    [types.DELETE_FROM_CART](state, { product_id }) {
        const record = state.added.find(p => p.product_id === product_id);
        if (record) {
            state.added.splice(state.added.indexOf(record), 1);
        }
    },
    [types.LIST_PRODUCTS](state, data) {
        state.productList = data;
    },
    [types.AUTH_SUCCESS](state, data) {
        // localStorage.setItem("token", data.token);
        // localStorage.setItem("user", data.user);
        state.status = "success";
        state.token = data.token;
        state.user = data.user;
    },
    [types.AUTH_ERROR](state) {
        state.status = "error";
    },
    [types.AUTH_LOGOUT](state) {
        // localStorage.setItem("token", "");
        // localStorage.setItem("user", {});
        // localStorage.setItem("added", []);
        state.added = [];
        state.token = "";
        state.user = {};
    },
    [types.GET_CART](state, data) {
        state.added = data;
        localStorage.setItem("added", data);
    },
    [types.SYNC_CART](state) {}
};

export default new Vuex.Store({
    state,
    plugins: [
        createPersistedState()
        //     {
        //     storage: {
        //         getItem: key => Cookies.get(key),
        //         setItem: (key, value) =>
        //             Cookies.set(key, value, { expires: 3, secure: true }),
        //         removeItem: key => Cookies.remove(key)
        //     }
        // }
    ],
    components: {
        products
    },
    strict: debug,
    getters,
    actions: {
        register({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios({ url: "api/register", data: user, method: "POST" })
                    .then(resp => {
                        let mData = {
                            token: resp.data.token,
                            user: resp.data.user
                        };
                        // localStorage.setItem('token', token)
                        axios.defaults.headers.common["Authorization"] =
                            "Bearer " + resp.data.token;
                        axios.defaults.headers.common[
                            "Access-Control-Allow-Headers"
                        ] = "*";

                        commit(types.AUTH_SUCCESS, mData);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit(types.AUTH_ERROR, err);
                        // localStorage.removeItem("token");
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
                            token: resp.data.token,
                            user: resp.data.user
                        };
                        // localStorage.setItem('token', token)
                        axios.defaults.headers.common["Authorization"] =
                            "Bearer " + resp.data.token;
                        axios.defaults.headers.common[
                            "Access-Control-Allow-Headers"
                        ] = "*";
                        commit(types.AUTH_SUCCESS, mData);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit(types.AUTH_ERROR);
                        // localStorage.removeItem("token");
                        reject(err);
                    });
            });
        },
        logout({ commit, dispatch, getters }) {
            // return new Promise((resolve, reject) => {
            //     axios({ url: "api/logout/", method: "POST" })
            //         .then(resp => {
            //             let data = {
            //                 user: getters.user.user_id,
            //                 cart: getters.cartProducts
            //             };
            //             dispatch("syncCart", data);
            delete axios.defaults.headers.common["Authorization"];
            commit(types.AUTH_LOGOUT);
            //             resolve();
            //         })
            //         .catch(err => {
            //             commit(types.AUTH_ERROR);
            //             reject(err);
            //         });
            // });
        },
        async getProducts(context) {
            await axios.get("api/products/").then(response => {
                context.commit(types.LIST_PRODUCTS, response.data);
            });
        }, // dispatch an action   ->    this.$store.dispatch("getProducts");
        async getCart({ commit }, data) {
            await axios.get("api/getCart?user=" + data.user).then(response => {
                commit(types.GET_CART, response.data);
            });
        },
        async syncCart({ commit }, data) {
            await axios.post("api/updateCart/", data).then(response => {
                commit(types.SYNC_CART, response.data);
            });
        },
        async syncCart({ commit }, data) {
            await axios.post("api/checkout/", data).then(response => {
                commit(types.SYNC_CART, response.data);
            });
        }
    },
    mutations
});
