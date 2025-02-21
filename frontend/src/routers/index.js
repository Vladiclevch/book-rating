import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../stores/authStore';
import RegisterView from '../views/RegisterView.vue';
import LoginView from '../views/LoginView.vue';
import HomeView from '../views/HomeView.vue';
import WelcomeView from '../views/WelcomeView.vue';
import NotFountView from '../views/NotFountView.vue';
import SettingsView from '../views/SettingsView.vue';
import AboutSection from '../components/sections/AboutSection.vue';
import CreateBookSection from '../components/sections/CreateBookSection.vue';
import ShowBookSection from '../components/sections/ShowBooksSection.vue';

const routes = [
  { path: '/', redirect: '/home' },
  { path: '/home', component: HomeView, children:
    [
      {
        path: "",
        redirect: "/home/books"
      },

      {
        path: 'about',
        component: AboutSection,
        meta: { requiresAuth: true }
      },

      {
        path: 'create',
        component: CreateBookSection,
        meta: { requiresAuth: true }
      },

      {
        path: 'books',
        component: ShowBookSection,
        meta: { requiresAuth: true }
      },
    ]
  },
  { path: '/welcome', component: WelcomeView },
  { path: '/register', component: RegisterView },
  { path: '/login', component: LoginView },
  { path: '/settings', component: SettingsView },
  { path: '/:pathMatch(.*)*', component: NotFountView },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const store = useAuthStore();

  if (to.meta.requiresAuth && !store.isAuthenticated) {
    next('/welcome');
  } else {
    next();
  }
});

export default router;
