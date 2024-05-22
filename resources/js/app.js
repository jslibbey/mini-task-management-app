import './bootstrap';

import { createApp } from 'vue'
import ToastPlugin from 'vue-toast-notification';
import router from './router.js'

import AppComponent from './components/App.vue'
import LoginForm from './components/auth/LoginForm.vue'
import RegisterForm from './components/auth/RegisterForm.vue'


const app = createApp({
    components: {
        LoginForm,
        RegisterForm,
        AppComponent
    }
})

app.use(router);
app.use(ToastPlugin);
app.mount('#app');
