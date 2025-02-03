import { createRouter, createWebHistory } from 'vue-router';
import RegisterView from '../views/RegisterView.vue';
import LoginViem from '../views/LoginViem.vue'

const routes = [
  { path: '/register', component: RegisterView },
  { path: '/login', component: LoginViem }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
