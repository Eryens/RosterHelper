/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Adding vform
import { Form, HasError, AlertError } from 'vform';
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

// Adding sortableJS
import draggable from 'vuedraggable';
window.draggable = draggable;

// Import object to formdata
import objectToFormData from 'object-to-formdata';
window.objectToFormData = objectToFormData;

// Adding sweetAlert
import swal from 'sweetalert2';
window.Swal = swal;

const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.Fire = new Vue();

window.Toast = Toast;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('order-list', require('./components/OrderList.vue').default);
Vue.component('display-order', require('./components/DisplayOrder.vue').default);
Vue.component('boss-list', require('./components/ListBosses').default);
Vue.component('user-list', require('./components/UserList.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

require('@fortawesome/fontawesome-free/js/all.js');