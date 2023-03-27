require('./bootstrap');

import { createApp } from 'vue';
import moment from 'moment';
import { DataTables } from 'vue-data-tables'
import LoginComponent from './components/LoginComponent'

window.$urlPlatform = 'http://127.0.0.1:8001';

const app = createApp({
    components: {
        LoginComponent
    }
})

app.use(DataTables);

// app.filter('formatDateSimple', function (value) {
//     if (value) {
//         return moment(String(value)).format('DD/MM/YYYY')
//     }
// });

app.mount('#login')


