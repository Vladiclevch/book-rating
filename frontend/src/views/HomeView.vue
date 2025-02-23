<script setup>
  import NavBar from '../components/bars/NavBar.vue';
  import SideBar from '../components/bars/SideBar.vue';
</script>

<template>
  <div class="flex h-full">
    <SideBar class="min-h-screen" />

    <div class="flex-1 flex flex-col">
      <NavBar />
      <main class="bg-neutral-800 flex-1 p-4">
        <router-view />
      </main>
    </div>
  </div>
</template>