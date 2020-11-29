<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Welcome to the OnlineShopper</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4" v-for="(product,index) in products" :key="index">
                            <router-link :to="{ path: '/products/'+product.product_id}">
                                <div class="card mb-3 mt-3 product-card-rounded">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <div class="card-header excursion-header">
                                                <img class="" width="100%" height="100%" :src="'/images/'+product.imageurl" :alt="product.name"/>
                                            </div>
                                            <div class="card-footer product-footer">
                                                <p class="px-3 pt-3 float-left product-name" v-html="product.name"></p>
                                                <p class="px-3 py-1 float-left product-price">$ {{product.price}}</p>
                                                <button class="btn btn-info float-right product-btn">Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        data(){
            return {
                products : []
            }
        },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)
        }
    }
</script>

<style scoped>
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }

    .title {
        font-size: 60px;
        color: #ffffff;
    }

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
