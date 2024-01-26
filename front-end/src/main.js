import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';
import './assets/main.css';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

library.add(fas, fab)
const app = createApp(App);

// Set up Axios globally
app.config.globalProperties.$axios = axios;

app.use(router).component('font-awesome-icon', FontAwesomeIcon);

app.mount('#app');