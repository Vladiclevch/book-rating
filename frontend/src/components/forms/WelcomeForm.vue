<script setup>
  import { useRouter } from 'vue-router';

  const router = useRouter();
</script>

<template>
  <div class="bg-gray-800 text-white text-center p-6 rounded-lg shadow-lg w-85 max-w-md mb-24">
    <h2 class="text-2xl mb-6">Welcome! Please Log in</h2>

    <div class="flex flex-col gap-4">
      <button 
        @click="router.push('/register')" 
        class="bg-blue-400 hover:bg-blue-500 font-bold py-2 rounded cursor-pointer"
      >
        Register
      </button>

      <button 
        @click="router.push('/login')" 
        class="bg-blue-400 hover:bg-blue-500 font-bold py-2 rounded cursor-pointer"
      >
        Log in
      </button>
    </div>
  </div>
</template>
