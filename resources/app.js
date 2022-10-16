import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

import Login from './screens/Login.vue';


new Vue({
    render: h => h(Login), // component name which is render in shortCode
}).$mount('#app') // shortCode div ID