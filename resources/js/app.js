require('./bootstrap');

import Vue from 'vue'

import App from './vue/app'
import NavbarMenu from './vue/components/menu'
import Router from 'vue-router'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faTrash, faSpinner  } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import VueSimpleAlert from "vue-simple-alert";
import VueCookie from 'vue-cookie';

// component
import Login from './vue/auth/login'
import PasswordResets from './vue/auth/password_resets'
import Register from './vue/auth/register'
import Verify from './vue/auth/verify'
import ChangePassword from './vue/auth/change_password'
import Dashboard from './vue/users/dashboard'
import Favorite from './vue/users/favorite'
import Logout from './vue/users/logout'
import NotFound from './vue/not-found'

library.add(faPlusSquare,faTrash, faSpinner)

Vue.component('font-awesome-icon',FontAwesomeIcon)
Vue.use(VueSimpleAlert)
Vue.use(Router)
Vue.use(VueCookie);


// setting router
const router = new Router({
    history: true,
    mode:'history',
    routes:[
        {
            path:'/',
            name:'login',
            component:Login,
            metaInfo: { title: 'Login - Favorite Company' }
        },
        {
            path:'/password_resets/new',
            name:'password_resets_new',
            component:PasswordResets,
            metaInfo: { title: 'Login - Favorite Company' }
        },
        {
            path:'/register',
            name:'register',
            component:Register,
            metaInfo: { title: 'Register - Favorite Company' }
        },
        {
            path:'/verify/:token',
            name:'verify',
            component:Verify,
            metaInfo: { title: 'Verify Account - Favorite Company' }
        },
        {
            path:'/change-password/:token',
            name:'change_password',
            component:ChangePassword,
            metaInfo: { title: 'Change Password - Favorite Company' }
        },
        {
            path:'/user/home',
            name:'home',
            component:Dashboard,
            metaInfo: { title: 'Home - Favorite Company' }
        },
        {
            path:'/user/favorite',
            name:'favorite',
            component:Favorite,
            metaInfo: { title: 'Favorite Compnay User - Favorite Company' }
        },
        {
            path:'/user/logout',
            name:'logout',
            component:Logout,
            metaInfo: { title: 'Logout - Favorite Company' }
        },
        {
            path:'*',
            component:NotFound
        }
    ],
});

const app = new Vue({
    el:"#app",
    components : {
        App,
        NavbarMenu
    },
    router,
});
