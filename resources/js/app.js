require('./bootstrap');

import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import '../sass/custom.scss';
import router from './router';
import common from './common';
Vue.mixin(common);

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


window.Vue = require('vue');
Vue.component('app', require('./components/App.vue').default);

const app = new Vue({
    el: '#root',
    router
});
