import './assets/main.css';
import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia';
import './axios';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import CountUp from 'vue-countup-v3';

library.add(fas, fab)

import App from './App.vue';
import router from './router';

const app = createApp(App);

const pinia = createPinia();

pinia.use(({ store }) => {
    store.router = markRaw(router);
});

app.use(pinia);
app.use(router).component('font-awesome-icon', FontAwesomeIcon);
app.component('CountUp', CountUp)

app.mount('#app');