<template>
    <div class="container">
        <div class="cart">
            <h1 class="title text-center pt-5">Your Cart</h1>
            <p v-show="!productList.length" class="text-center">
                <i>Your cart is empty!</i>
                <router-link to="/products">Go shopping</router-link>
            </p>
            <transition name="fade" v-on:enter="enter">
                <p v-if="show">
                    Order Placed successfully
                </p>
            </transition>

            <table class="table is-striped" v-show="productList.length">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="p in productList" :key="p.id">
                        <td>{{ p.product_name }}</td>
                        <td>${{ p.price }}</td>
                        <td>
                            <div class="quantity-toggle">
                                <button @click="removeItemFromCart(p)">
                                    &mdash;
                                </button>
                                <input
                                    class="quantityInp"
                                    type="text"
                                    v-model="p.quantity"
                                    readonly
                                />
                                <button @click="addItemToCart(p)">
                                    &#xff0b;
                                </button>
                            </div>
                        </td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-default"
                                @click="deleteItem(p)"
                                aria-label="Left Align"
                            >
                                <span
                                    class="fa fa-trash-o fa-lg"
                                    aria-hidden="true"
                                ></span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Total:</b></td>
                        <td></td>
                        <td></td>
                        <td>
                            <b>${{ total }}</b>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>
                <button
                    v-show="productList.length"
                    class="btn btn-primary float-right mr-5"
                    @click="checkout"
                >
                    Checkout
                </button>
            </p>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import _ from "lodash";
export default {
    data() {
        return {
            show: false
        };
    },
    computed: {
        ...mapGetters({
            productList: "cartProducts",
            user: "loggedUser"
        }),
        total() {
            return this.productList.reduce((total, p) => {
                return total + p.price * p.quantity;
            }, 0);
        }
    },
    methods: {
        addItemToCart(product) {
            this.$store.commit("ADD_TO_CART", product);
            this.syncCart();
        },
        removeItemFromCart(product) {
            this.$store.commit("REMOVE_FROM_CART", product);
            this.syncCart();
        },
        deleteItem(product) {
            this.$store.commit("DELETE_FROM_CART", product);
            this.syncCart();
        },
        syncCart: _.debounce(() => {
            if (this.user.user_id !== undefined) {
                let data = {
                    user: this.user.user_id,
                    cart: this.productList
                };
                this.$store.dispatch("syncCart", data);
            }
        }, 2000),
        checkout() {
            if (this.user.user_id !== undefined) {
                let data = {
                    user: this.user.user_id,
                    cart: this.productList
                };
                this.$store.dispatch("checkout", data).then(resp => {
                    this.show = !this.show;
                });
            } else {
                this.$router.push("/checkoutDetails");
            }
        },
        enter: function(el, done) {
            var that = this;
            setTimeout(function() {
                that.show = false;
            }, 3000);
        }
    },
    created: function() {
        if (this.productList.length > 0 && this.user.user_id !== undefined) {
            let data = {
                user: this.user.user_id,
                cart: this.productList
            };
            this.$store.dispatch("syncCart", data);
        }
    }
};
</script>

<style scoped>
.quantityInp {
    max-width: 50px;
}
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
