import './bootstrap';

import { createApp } from 'vue'
import router from './router.js'

import AppComponent from './components/App.vue'
import LoginForm from './components/auth/LoginForm.vue'


const app = createApp({
    components: {
        LoginForm,
        AppComponent
    }
})


app.use(router);
app.mount('#app');
