<script setup>

</script>

<template>
  <nav class="bg-neutral-600 text-white p-4">

    <div class="flex justify-between items-center">

      <button @click="router.push('/create')">ADD BOOK</button>

      <div>
        TO DO search
      </div>

      <div class="relative">
        <img 
        src=""
        alt="User"
        @click="toggleDropdown"
        >

        <div v-if="dropdownOpen" class="relative">
          <ul>
            <li @click="router.push('/settings')">
              Settings
            </li>
            
            <li @click="router.push('/logout')">
              Logout
            </li>
          </ul>
        </div>

      </div>

    </div>

  </nav>
</template>
