import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import theme from '../src/assets/theme.css'

const app = createApp(App);
app.use(store);
app.use(router);
app.use(theme);
app.mount('#app');
