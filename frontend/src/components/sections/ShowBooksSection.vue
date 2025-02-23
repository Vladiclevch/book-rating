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

  const removeBook = (bookId) => {
    books.value = books.value.filter(book => book.id !== bookId);
  };

  const updateBookInList = (updatedBook) => {
  const index = books.value.findIndex(book => book.id === updatedBook.id);
  if (index !== -1) {
    books.value[index] = { ...books.value[index], ...updatedBook };
  }
};
</script>

<template>
  <div>
    <h2 class="text-white mb-2 text-xl">My Books</h2>

    <div v-if="books.length">
      <div v-for="book in books" :key="book.id" class="text-white">
        <BookForm :book="book" @bookDeleted="removeBook" @bookUpdated="updateBookInList" />
      </div>
    </div>

    <p v-else class="text-white">No books yet</p>
  </div>
</template>
