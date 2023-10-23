window.axios = require('axios');
window._ = require('lodash');
window.Vue = require('vue').default;

import Vue from 'vue';
import VueSkeletonLoader from 'skeleton-loader-vue';

// Register the component globally
Vue.component('vue-skeleton-loader', VueSkeletonLoader);

Vue.component('find-doctor', require('./components/FindDoctorPage.vue').default);

const app = new Vue({
    el: '#app',
});

