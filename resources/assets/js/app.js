require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';

import * as VueGoogleMaps from "vue2-google-maps";

import App from './App.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import UserTable from './components/UserTable';
import AdminTable from './components/AdminTable';
import MapGoogle from './components/MapGoogle';
import ForgotPassword from './components/ForgotPassword'

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://localhost/api';
const router = new VueRouter({
    routes: [{
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
        {
            path: '/forgotpass',
            name: 'forgotpass',
            component: ForgotPassword,
            meta: {
                auth: false
            }
        }, {
            path: '/',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        }, {
            path: '/admintable',
            name: 'admintable',
            component: AdminTable,
            meta: {
                auth: true
            }
        }, {
            path: '/userTable',
            name: 'usertable',
            component: UserTable,
            meta: {
                auth: true
            }
        }, {
            path: '/map',
            name: 'map',
            component: MapGoogle,
            meta: {
                auth: true
            },
        }, {
            // path: '/password/reset/:token'
            },
    ]
});
Vue.router = router;
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyDJjXA4HidhwOzBgutI2NhRcGGsgPzIOas",
        libraries: "places" // necessary for places input
    }
});

App.router = Vue.router;

new Vue(App).$mount('#app');





