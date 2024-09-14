

import { createApp } from 'vue'
import { BootstrapVue } from 'bootstrap-vue-next';

import App from './App.vue'
import router from './router.js'
import store from './store/store';

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css';
import 'bootstrap-icons/font/bootstrap-icons.css';


const app = createApp(App);
app.use(BootstrapVue);
app.use(router);
app.use(store);
app.mount('#app');