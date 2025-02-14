<script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import defaultProfileImage from '@/assets/icons/profile-default.svg';

  const dropdownOpen = ref(false);
  const router = useRouter();

  const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
  }
</script>

<template>
  <nav class="bg-neutral-600 text-white p-4">

    <div class="flex justify-between items-center">

      <router-link
      to="/home/create"
      class="bg-blue-400 hover:bg-blue-500 text-white py-2 rounded cursor-pointer w-24 text-center">
      ADD BOOK</router-link>

      <div>
        TO DO search
      </div>

      <div class="relative">
        <img 
        :src="userImage || defaultProfileImage"
        alt="User"
        @click="toggleDropdown"
        class="w-10 h-10 rounded-full cursor-pointer object-cover bg-amber-50"
        >
        <div v-if="dropdownOpen" class="absolute right-0 mt-2 bg-gray-700 rounded w-24 overflow-auto">
          <ul class="">
            <li @click="router.push('/settings')" class="px-4 py-2 hover:bg-gray-800 cursor-pointer">
              Settings
            </li>
            
            <li @click="router.push('/logout')" class="px-4 py-2 hover:bg-gray-800 cursor-pointer">
              Logout
            </li>
          </ul>
        </div>
      </div>

    </div>

  </nav>
</template>
