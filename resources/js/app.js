require('./bootstrap')
const routes = require('./routes');
import { createApp } from 'vue';
import moment from 'moment';
import { createRouter, createWebHistory } from 'vue-router';
import FooterWidget from './widgets/FooterWidget';
import NavbarWidget from './widgets/NavbarWidget';
import SidebarWidget from './widgets/SidebarWidget';
//import VueSelect from '@desislavsd/vue-select';
import Toggle from '@vueform/toggle';

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Select2 from 'vue3-select2-component';

import { DataTables } from 'vue-data-tables';

const router = createRouter({
    history: createWebHistory(),
    routes: routes.routes,
    mode: 'history'
});

const app = createApp({
    components: {
        NavbarWidget,
        FooterWidget,
        SidebarWidget,
    }
});

axios.interceptors.request.use((config) => {

    if (config.headers.Authorization && config.method == 'get') {
        if (config.headers.Authorization != '' && config.url.indexOf(window.location.origin) == -1 && config.url.indexOf("/") !== 0) {
            config.headers.Authorization = config.headers.Authorization.indexOf('Bearer') === 0 ? config.headers.Authorization : 'Bearer ' + config.headers.Authorization;
        }
    }
    jQuery('.preloader').css({ 'height': '100%', 'background-color': 'rgba(0, 0, 0, 0.5)' }).show();
    jQuery('.preloader img').show();
    return config;
}, (error) => {
    jQuery('.preloader').hide().css({ 'height': '0' });
    jQuery('.preloader img').hide();
    return Promise.reject(error);
});

axios.interceptors.response.use((response) => {
    jQuery('.preloader').hide().css({ 'height': '0' });
    jQuery('.preloader img').hide();
    return response;
}, (error) => {
    jQuery('.preloader').hide().css({ 'height': '0' });
    jQuery('.preloader img').hide();
    return Promise.reject(error);
});

app.use(router);
app.use(VueSweetalert2);

// axios.get(`${window.$urlPlatform}/api/user`, {
//     headers: {
//         'Authorization': 'Bearer ' + window.AT
//     }
// }).then((resp) => {
//     window.localStorage.setItem('userDataMin', JSON.stringify(resp.data.user));
// });

app.config.globalProperties.UserData = () => {
    return window.localStorage.getItem('userDataMin') ? JSON.parse(window.localStorage.getItem('userDataMin')) : null;
};
app.config.globalProperties.LaravelPermission = window.LaravelPermission;
app.config.globalProperties.AccessToken = window.AT;
app.config.globalProperties.$appName = window.$appName;
app.config.globalProperties.urlPlatform = window.$urlPlatform;



app.component('Toggle', Toggle);
app.component('VueDatePicker', VueDatePicker);
app.component('Select2', Select2)



app.mount('#app')
