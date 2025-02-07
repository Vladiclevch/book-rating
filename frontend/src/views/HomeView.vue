<script setup>
  import { useRouter } from 'vue-router';
  import { useAuthStore } from '../stores/authStore';

  const authStore = useAuthStore();
  const router = useRouter();

  const logout = () => {
    authStore.logout();
    router.push('/home');
  }
</script>

<template>
  <div>
    <div v-if="authStore.isAuthenticated">
      <p>hello</p>
      <button @click="logout">Logout</button>
    </div>

    <div v-else>
      <button @click="router.push('/login')">Login</button>
      <button @click="router.push('/register')">Register</button>
    </div>
  </div>
</template>
