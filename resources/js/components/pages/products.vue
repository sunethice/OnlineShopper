<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="row mb-3 mt-3 mr-2">
                        <div class="form-inline mr-auto mb-3">
                            <label class="font-weight-bold mb-2" for="formName">Search by name</label>
                            <input id="formName" type="text" class="form-control" v-model="prodName">
                        </div>
                        <div class="form-inline mr-auto mb-3">
                            <label class="font-weight-bold mb-2" for="formPrcRng">Filter by price </label>
                            <input id="formPrcRng" type="range" class="custom-range" min="0" max="200" step="1" v-model="prodPrice">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4" v-for="(product,index) in items" :key="index" v-if="product.price<=Number(prodPrice)">
                            <!-- <router-link :to="{ path: '/products/'+product.product_id}"> -->
                                <div class="card mb-3 mt-3 product-card-rounded">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <div class="card-header excursion-header">
                                                <img width="100%" height="100%" :src="'/images/'+product.imageurl" :alt="product.name"/>
                                            </div>
                                            <div class="card-footer product-footer">
                                                <p class="px-3 pt-3 float-left product-name" v-html="product.name"></p>
                                                <p class="px-3 py-1 float-left product-price">$ {{product.price}}</p>
                                                <button class="btn btn-info float-right product-btn" @click="addItemToCart(product)">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </router-link> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script type="text/javascript">
    import { mapGetters, mapActions } from 'vuex';
    export default {
        data(){
            return {
                prodName:"",
                prodPrice:99,
                // products : []
            }
        },
        computed: mapGetters({
            items: 'allProducts'
        }),
        methods:{
            addItemToCart(product){
                this.$store.commit('ADD_TO_CART',product);
            }
        },
        // methods: mapActions([
        //     'addToCart'
        // ]),
        created(){
            this.$store.dispatch("getProducts");
        }
    }
</script>

<style scoped>

    .product-card-rounded {
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .product-header{
        padding:0px;
    }

    .product-header img{
        height: 100%;
    }

    .product-footer{
        padding:0px;
        border: unset;
    }

    .product-name{
        margin-bottom: 0px;
        font-size: 14px;
        line-height: 32px;
        width: 100%;
    }

    .product-price{
        margin-bottom: 0px;
        font-size: 22px;
        line-height: 32px;
        width: 100%;
    }

    .product-btn{
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
        margin-right: 1rem !important;
    }
</style>
