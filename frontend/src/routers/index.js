import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/authStore';
import RegisterView from '../views/RegisterView.vue';
import LoginView from '../views/LoginView.vue';
import HomeView from '../views/HomeView.vue';
import About from '../components/sections/AboutSection.vue';
import NotFountView from '../views/NotFountView.vue';
import SettingsView from '../views/SettingsView.vue'

const routes = [
  { path: '/', redirect: '/home' },
  { path: '/home', component: HomeView, children: [
    {
      path: 'about',
      component: About,
      meta: { requiresAuth: false }
    }
  ] },
  { path: '/register', component: RegisterView },
  { path: '/login', component: LoginView },
  { path: '/settings', component: SettingsView },
  { path: '/:pathMatch(.*)*', component: NotFountView },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to) => {
  const store = useAuthStore();

  if (to.meta.requiresAuth && !store.isAuthenticated) {
    return '/home';
  }
});

export default router;
