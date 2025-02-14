<script setup>

</script>

<template>
  <aside class="bg-neutral-700 w-64 p-4 flex flex-col justify-between h-full">

    <div class="mb-6 self-center">
      <router-link to="/home">
        <h1 class="text-xl text-white font-black">📚Book Rating📚</h1>
      </router-link>
    </div>

    <div class="text-white">
      TO DO folders
    </div>

    <div class="border-t border-amber-400">
      <router-link to="/home/about" class="text-white hover:text-blue-400 px-10">About Book Rating</router-link>
    </div>
  </aside>
</template>
