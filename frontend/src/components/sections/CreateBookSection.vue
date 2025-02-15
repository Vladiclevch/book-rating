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
    formData.append('picture', picture.value);
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
  <form action="">

    <div>
      <label for="picture">Picture</label>
      <input
      id="picture"
      type="file">
    </div>

    <div>
      <label for="title">Title</label>
      <input
      id="title"
      type="text">
    </div>

    <div>
      <label for="description">Description</label>
      <input
      id="description"
      type="text">
    </div>

    <div>
      <label for="grade">Grade</label>
      <select id="grade">
        <option value="" disabled>Choose a grade</option>
        <option value="">Read later</option>
        <option value="">Excellent</option>
        <option value="">Good</option>
        <option value="">Average</option>
        <option value="">Bad</option>
        <option value="">Disgusting</option>
      </select>
    </div>

    <button type="submit">
      Save
    </button>
  </form>
</template>
