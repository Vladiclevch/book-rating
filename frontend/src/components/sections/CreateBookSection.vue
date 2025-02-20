<script setup>
  import { ref } from 'vue';
  import { createBook } from '../../api/book'

  const picture = ref(null);
  const title = ref('');
  const description = ref('');
  const grade = ref('');
  const grades = ['Read later', 'Excellent', 'Good', 'Average', 'Bad', 'Disgusting'];

  const handleFileUpload = (event) => {
    picture.value = event.target.files[0];
  };

  const submitForm = async() => {
    const formData = new FormData();
    formData.append('img', picture.value);
    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('grade', grade.value);

    try {
      const response = await createBook(formData);
      alert('Book added successfully!');
    } catch (error) {
      alert('Error submitting form. Please try again.');
    }
  }
</script>

<template>
  <form @submit.prevent="submitForm" class="flex flex-col items-start">

    <div class="mb-4">
      <label for="picture" class="block text-white font-bold mb-2">Picture</label>
      <input
      id="picture"
      type="file"
      @change="handleFileUpload"
      class="bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2">
    </div>

    <div class="mb-4">
      <label for="title" class="block text-white font-bold mb-2">Title</label>
      <input
      id="title"
      type="text"
      v-model="title"
      class="bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2">
    </div>

    <div class="mb-4">
      <label for="description" class="block text-white font-bold mb-2">Description</label>
      <input
      id="description"
      type="text"
      v-model="description"
      class="bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2">
    </div>

    <div class="mb-4">
      <label for="grade" class="block text-white font-bold mb-2">Grade</label>
      <select id="grade" v-model="grade" class="bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2">
        <option value="" disabled>Choose a grade</option>
        <option v-for="grade in grades" :key="grade" :value="grade">{{ grade }}</option>
      </select>
    </div>

    <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white py-1 rounded cursor-pointer w-12 text-center">
      SAVE
    </button>

  </form>
</template>
