import Vue from "vue";
import VueRouter from "vue-router";
import home from "./components/pages/home";
import products from "./components/pages/products";
import cart from "./components/pages/cart";
import product from "./components/pages/product";
import auth from "./components/pages/auth";
import register from "./components/pages/register";
import checkoutDetails from "./components/pages/checkoutDetails";

Vue.use(VueRouter);

const routes = [
    {
        path: "/home",
        component: home
    },
    {
        path: "/products",
        component: products
    },
    {
        path: "/product",
        component: product
    },
    {
        path: "/auth",
        component: auth
    },
    {
        path: "/register",
        component: register
    },
    {
        path: "/cart",
        component: cart
    },
    {
        path: "/checkoutDetails",
        component: checkoutDetails
    }
];

export default new VueRouter({
    mode: "history",
    routes
});
