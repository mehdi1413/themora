import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

import Toast , { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App)

app.use(Toast, {
    containerClassName: "themora-toast-container",
    position: POSITION.BOTTOM_LEFT,
    transition: "Vue-Toastification__bounce",
    maxToasts: 4,
    newestOnTop: true,
    timeout: 3000,
    rtl: true
});

app.mount('#themora-app')