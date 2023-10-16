import '../css/app.css';

import {createApp} from 'vue'

import App from './App.vue'
import router from "/resources/js/router"
createApp(App).use(router).mount("#app")