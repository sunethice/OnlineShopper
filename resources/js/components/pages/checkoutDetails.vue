<template>
    <div class="container">
        <div class="row d-flex justify-content-center pb-4">
            <h1 class="title text-center pt-5">Checkout details</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-row mb-3">
                        <div class="col">
                            <input
                                type="text"
                                v-model="name"
                                class="form-control signinEntry"
                                placeholder="Name"
                            />
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <input
                                type="email"
                                v-model="email"
                                class="form-control signinEntry"
                                placeholder="Email"
                            />
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <textarea
                                type="text"
                                v-model="address"
                                class="form-control signinEntry"
                                placeholder="address"
                            />
                        </div>
                    </div>
                    <p v-if="errors.length">
                        <b>Please correct the following error(s):</b>
                        <ul>
                            <li v-for="(error,index) in errors" :key="index">{{ error }}</li>
                        </ul>
                    </p>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table is-striped" >
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Quantity</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in productList" :key="p.id">
                            <td>{{ p.product_name }}</td>
                            <td>{{ p.quantity }}</td>
                            <td>${{ p.price }}</td>
                        </tr>
                        <tr>
                            <td><b>Total:</b></td>
                            <td></td>
                            <td>
                                <b>${{ total }}</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-show="!productList.length">Order Placed successfully</div>
            </div>
        </div>
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
</template>

<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            name: "",
            email: "",
            address: "",
            errors: []
        };
    },
    computed: {
        ...mapGetters({
            productList: "cartProducts"
        }),
        total() {
            return this.productList.reduce((total, p) => {
                return total + p.price * p.quantity;
            }, 0);
        }
    },
    methods: {
        checkout() {
            if (this.validateUserInfo()) {
                let mData = {
                    name: this.name,
                    email: this.email,
                    address: this.address,
                    cart: this.productList
                };
                this.$store.dispatch("checkout", mData).then(resp =>{
                    if(resp.status == 200){
                        this.name = "";
                        this.email = "";
                        this.address = "";
                    }
                });
            }
        },
        validateUserInfo(){
            if (this.name != "" && this.email != "" && this.address != "")
                return true;
            if(!this.name)
                this.errors.push('Client name is required.');
            if(!this.email)
                this.errors.push('Client email is required.');
            if(!this.address)
                this.errors.push('Client address is required.');
        }
    }
};
</script>

<style scoped>
.quantityInp {
    max-width: 50px;
}
</style>
