import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import routers from './routers'
import { createPinia } from 'pinia'

createApp(App).use(routers).use(createPinia()).mount('#app')
