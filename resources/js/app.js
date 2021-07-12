/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');

window.Vue = require('vue');

import router from "./routers.js";
import Form from 'vform';
window.Form=Form;

import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
} from 'vform/src/components/bootstrap5'
Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)


import Swal from 'sweetalert2'
window.Swal=Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast=Toast;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import moment from 'moment'
Vue.filter('myDate',function (createAt){
    return moment(createAt).format('MMMM Do YYYY, h:mm:ss a');
})
// import VueMoment from 'vue-moment'
// Vue.use(VueMoment,moment);// Vue use moment.js
Vue.filter('upText',function (text){
    return text.toUpperCase();
})
import VueProgressBar from 'vue-progressbar'

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options)

window.Fire=new Vue();

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);
Vue.component('pagination', require('laravel-vue-pagination'));

import Gate from "./Gate";
Vue.prototype.$gate=new Gate(window.user);
const app = new Vue({
    el: '#app',
    router,
   data(){
        return {
            search:''

        };
     },
    methods:{
        searchit:_.debounce(() => {
            Fire.$emit('searching');
            },1000),

            printme() {
                window.print();
            }

    }

    // watch:{
    //     $route (to, from){
    //         console.log("aa");
    //         var user = '{{auth()->check()}}';
    //         if (user==' '){
    //             window.location.href = "{{route('login')}}"
    //
    //         }
    //     }
    // }

});
