<template>
    <div>
        <navbar></navbar>
        <router-view></router-view>
    </div>
</template>

<style lang="scss">

.navbar-toggler-icon {
    background-image: url("../../img/hamburger.svg");
}
</style>

<script type="text/javascript">
  import navbar from './navbar.vue'
  export default{
    components:{
      navbar // register component
    }
  }
</script>
