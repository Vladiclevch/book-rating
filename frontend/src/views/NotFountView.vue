<script setup>
  import { useRouter } from 'vue-router';

  const router = useRouter();
</script>

<template>
  <div class="bg-neutral-600 flex justify-center items-center w-screen h-screen">

    <div class="text-center mb-24">
      <p class="text-6xl font-bold text-gray-900">404</p>
      <p class="text-4xl font-bold text-gray-900 pt-3 pb-6">Sorry, not found</p>
      <button
      type="button"
      @click="router.push('/home')"
      class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 rounded cursor-pointer w-30">
        Return home
      </button>
    </div>

  </div>
</template>
