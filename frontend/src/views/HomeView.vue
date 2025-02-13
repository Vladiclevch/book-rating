<script setup>
  import NavBar from '../components/bars/NavBar.vue';
  import SideBar from '../components/bars/SideBar.vue';
  import WelcomeForm from '../components/forms/WelcomeForm.vue';
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

  <div v-if="authStore.isAuthenticated" class="flex h-screen">
    <SideBar/>
    <div class="flex-1 flex flex-col">
      <NavBar />

      <main class="bg-gray-400 flex-1 p-4 ">
        TO DO list
      </main>

    </div>
  </div>

  <div v-else class="bg-gray-600 flex justify-center items-center w-screen h-screen">
    <WelcomeForm />
  </div>
</template>
