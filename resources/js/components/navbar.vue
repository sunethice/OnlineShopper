<template>
    <div id="topnav">
        <nav class="navbar navbar-expand-lg py-3" style="background-color: #012d6b;">
            <a class="navbar-brand mx-lg-auto text-white" href="#">Online Shopper</a>
            <div class="navbar-collapse collapse w-100 order-3 menu-content">
                <div class="navbar-nav ml-auto menu-content">
                    <router-link to="home" class="nav-item nav-link px-3 text-white">Home</router-link>
                    <router-link to="products" class="nav-item nav-link px-3 text-white">Products</router-link>
                    <router-link to="auth" class="nav-item nav-link px-3 text-white">SignIn</router-link>
                    <router-link to='cart' class="btn btn-info">
                        <span class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </span>
                        <span v-show="itemsInCart>0">({{itemsInCart}})</span>
                    </router-link>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".menu-content">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
</template>

<script type="text/javascript">
    import { mapGetters } from 'vuex';

    export default {
        computed: {
            itemsInCart(){
                let cart = this.$store.getters.cartProducts;
                return cart.reduce((accum, item) => accum + item.quantity, 0)
            }
        }
    }
</script>
