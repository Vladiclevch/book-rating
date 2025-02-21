<script setup>
  import { ref } from 'vue';
  import { createBook } from '../../api/book'

  const picture = ref(null);
  const title = ref('');
  const description = ref('');
  const grade = ref('');
  const grades = ['Read later', 'Excellent', 'Good', 'Average', 'Bad', 'Disgusting'];
  const fileUploaded = ref(false);

  const handleFileUpload = (event) => {
    picture.value = event.target.files[0];

    if (picture.value) {
      fileUploaded.value = true;
    }
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

    <div class="mb-4 w-full">
      <label for="title" class="block text-white font-bold mb-2">Book title</label>
      <input
      id="title"
      type="text"
      v-model="title"
      class="w-full bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2">
    </div>

    <div class="mb-4 w-full">
      <label for="description" class="block text-white font-bold mb-2">Description</label>
      <textarea id="description" v-model="description" class="w-full bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-2">
      </textarea>
    </div>

    <div class="mb-4 w-full">
      <label for="grade" class="block text-white font-bold mb-2">Grade</label>
      <select id="grade" v-model="grade" class="bg-neutral-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 p-3">
        <option value="" disabled>Choose a grade</option>
        <option v-for="grade in grades" :key="grade" :value="grade">{{ grade }}</option>
      </select>
    </div>

    <div class="mb-4">
      <label for="picture" class="block text-white font-bold mb-2">Book Picture</label>
      <div class="relative">
        <input id="picture" type="file" @change="handleFileUpload" class="hidden">
        <label for="picture" class="bg-neutral-700 text-white py-2 px-4 rounded-lg cursor-pointer block text-center hover:bg-neutral-600">
          {{ fileUploaded ? "Picture uploaded!" : "Choose a file" }}
        </label>
      </div>
    </div>

    <button type="submit" class="mt-4 bg-blue-400 hover:bg-blue-500 text-white py-2 rounded cursor-pointer w-14 text-center">
      SAVE
    </button>

  </form>
</template>
