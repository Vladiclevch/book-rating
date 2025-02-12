<script setup>
  import NavBar from '../components/bars/NavBar.vue';
  import SideBar from '../components/bars/SideBar.vue';
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

  <template v-if="authStore.isAuthenticated">
    <div class="flex h-screen">
      <SideBar/>
      <div class="flex-1 flex flex-col">
        <NavBar />

        <main class="bg-gray-400 flex-1 p-4 ">
          TO DO list
        </main>

      </div>
    </div>
  </template>

  <template v-else>
    <div class="bg-gray-600 flex justify-center items-center w-screen h-screen">
      <div class="bg-gray-800 text-white text-center p-6 rounded-lg shadow-lg w-85 max-w-md mb-24">
        <h2 class="text-2xl mb-6">Welcome! Please Log in</h2>

        <div class="flex flex-col gap-4">
        <button 
          @click="router.push('/register')" 
          class="bg-blue-400 py-2 rounded"
        >
        Register
        </button>
  
        <button 
          @click="router.push('/login')" 
          class="bg-blue-400 py-2 rounded"
          >
          Login
          </button>
        </div>
      </div>
    </div>
  </template>
</template>
