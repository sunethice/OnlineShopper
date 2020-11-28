<template>
    <div id="topnav">
        <nav class="navbar navbar-expand-lg py-3" style="background-color: #012d6b;">
            <a class="navbar-brand mx-lg-auto text-white" href="#">Online Shopper</a>
            <div class="navbar-collapse collapse w-100 order-3 menu-content">
                <div class="navbar-nav ml-auto menu-content">
                    <router-link to="home" class="nav-item nav-link px-3 text-white">Home</router-link>
                    <router-link to="Products" class="nav-item nav-link px-3 text-white">Products</router-link>
                    <router-link to="SignIn" class="nav-item nav-link px-3 text-white">SignIn</router-link>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".menu-content">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
</template>
