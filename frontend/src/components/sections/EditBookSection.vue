<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { getBook, editBook } from '../../api/book';

const route = useRoute();
const router = useRouter();
const book = ref({
  title: '',
  description: '',
  grade: '',
});
const picture = ref(null);

const grades = ['Read later', 'Excellent', 'Good', 'Average', 'Bad', 'Disgusting'];
const fileUploaded = ref(false);

onMounted(async () => {
  try {
    const response = await getBook(route.params.id);
    book.value = response;
  } catch (error) {
    console.error('Error loading book:', error);
  }
});

const handleFileUpload = (event) => {
    picture.value = event.target.files[0];

    if (picture.value) {
      fileUploaded.value = true;
    }
};

const submitForm = async () => {
  const formData = new FormData();

  if (picture.value) {
    formData.append('img', picture.value);
  }
  formData.append('title', book.value.title);
  formData.append('description', book.value.description);
  formData.append('grade', book.value.grade);

  try {
    const response = await editBook(route.params.id, formData);
    alert('Book updated successfully!');
    router.push('/home/books');
  } catch (error) {
    console.error(error);
    alert('Error updating book. Please try again.');
  }
};
</script>

<template>
  <div class="max-w-xl mx-auto mt-10">
    <h2 class="text-white text-xl mb-4">Edit Book</h2>

    <form @submit.prevent="submitForm" class="flex flex-col">
      <div class="mb-4 w-full">
        <label for="title" class="block text-white font-bold mb-2">Book Title</label>
        <input 
          id="title" 
          type="text" 
          v-model="book.title"
          class="w-full bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2"
        />
      </div>

      <div class="mb-4 w-full">
        <label for="description" class="block text-white font-bold mb-2">Description</label>
        <textarea 
          id="description" 
          v-model="book.description"
          class="w-full bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2"
        ></textarea>
      </div>

      <div class="mb-4 w-full">
        <label for="grade" class="block text-white font-bold mb-2">Grade</label>
        <select 
          id="grade" 
          v-model="book.grade"
          class="bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3"
        >
          <option value="" disabled>Choose a grade</option>
          <option v-for="grade in grades" :key="grade" :value="grade">{{ grade }}</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="picture" class="block text-white font-bold mb-2">Book Picture</label>
        <div class="relative">
          <input 
            id="picture" 
            type="file" 
            @change="handleFileUpload" 
            class="hidden"
          />
          <label 
            for="picture" 
            class="bg-neutral-700 text-white py-2 px-4 rounded-lg cursor-pointer block text-center hover:bg-neutral-600"
          >
            {{ fileUploaded ? "Picture uploaded!" : "Choose a file" }}
          </label>
        </div>
      </div>

      <button 
        type="submit" 
        class="mt-4 bg-blue-400 hover:bg-blue-500 text-white py-2 rounded cursor-pointer w-24 text-center"
      >
        UPDATE
      </button>
    </form>
  </div>
</template>
