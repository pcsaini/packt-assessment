/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import '../sass/app.scss'
import router from '@/routes'
import axios from '@/helpers/interceptors';
import VueAxios from 'vue-axios'
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import {createApp} from 'vue'

import App from './App.vue'

const app = createApp(App)
app.use(router)
app.use(VueAxios, axios)
app.use(Toast);
app.use(VueSweetalert2);
app.component('EasyDataTable', Vue3EasyDataTable);
app.mount('#app')
