import { createRouter, createWebHistory } from 'vue-router';
import RegisterView from '../views/RegisterView.vue';
import LoginView from '../views/LoginView.vue'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'

const routes = [
  { path: '/', redirect: '/home' },
  { path: '/home', component: HomeView },
  { path: '/register', component: RegisterView },
  { path: '/login', component: LoginView },
  { path: '/about', component: AboutView }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
