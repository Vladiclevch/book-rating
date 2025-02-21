<script setup>
  import { ref, onMounted } from 'vue'
  import { getBooks } from '../../api/book';
  import { useAuthStore } from '../../stores/authStore.js'
  import BookForm from '../forms/BookForm.vue';

  const books = ref([]);
  const authStore = useAuthStore();

  onMounted(async () => {
    if (authStore.isAuthenticated) {
      try {
        books.value = await getBooks();
      } catch (error) {
        console.error("Something wrong:", error);
      }
    }
  });
</script>

<template>
  <div>
    <h2 class="text-white">My Books</h2>

    <div v-if="books.length">
      <div v-for="book in books" :key="book.id" class="text-white">
        <BookForm :book="book" />
      </div>
    </div>

    <p v-else class="">No books yet</p>
  </div>
</template>
