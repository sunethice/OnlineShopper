import Vue from 'vue';
import VueRouter from 'vue-router';
import home from './components/pages/home';
import products from './components/pages/products';
import product from './components/pages/product';

Vue.use(VueRouter);

const routes =[
    {
        path:'/home',
        component: home
    },
    {
        path:'/products',
        component: products
    },
    {
        path:'/product',
        component: product
    }
]

export default new VueRouter({
    mode:'history',
    routes
});
