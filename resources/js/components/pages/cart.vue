<template>
  <div class="cart">
    <h1 class="title text-center pt-5">Your Cart</h1>
    <p v-show="!productList.length" class="text-center">
      <i>Your cart is empty!</i>
      <router-link to="/products">Go shopping</router-link>
    </p>
    <table class="table is-striped" v-show="productList.length">
      <thead>
        <tr>
          <td>Name</td>
          <td>Price</td>
          <td>Quantity</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="p in productList" :key="p.id">
            <td>{{ p.name }}</td>
            <td>${{ p.price }}</td>
            <td>{{ p.quantity }}</td>
          </tr>
          <tr>
            <td><b>Total:</b></td>
            <td></td>
            <td><b>${{ total }}</b></td>
          </tr>
      </tbody></table>
    <p><button v-show="productList.length" class='btn btn-primary float-right mr-5' @click='checkout'>Checkout</button></p>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  computed: {
    ...mapGetters({
      productList: 'cartProducts'
    }),
    total () {
      return this.productList.reduce((total, p) => {
        return total + p.price * p.quantity
      }, 0)
    }
  },
  methods: {
    checkout(){
      alert('Pay us $' + this.total)
    }
  }
}
</script>
