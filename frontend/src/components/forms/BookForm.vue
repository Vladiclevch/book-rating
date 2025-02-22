<script setup>
  import { computed } from 'vue';
  import { deleteBook } from '../../api/book';
  import defaultBookTitle from '../../assets/icons/book-title-default.jpg'

  const bookProps = defineProps({
    book: {
      type: Object,
      required: true
    }
  });

  const imageUrl = computed(() => {
    return bookProps.book.img
      ? `http://127.0.0.1:8000/storage/${bookProps.book.img}`
      : defaultBookTitle;
  });

  const emit = defineEmits(['bookDeleted']);

  const handleDelete = async () => {
    try {
      await deleteBook(bookProps.book.id);
      emit('bookDeleted', bookProps.book.id);
    } catch (error) {
      console.error('Error deleting book:', error);
    }
  };

  const gradeClass = computed(() => {
    const grade = bookProps.book.grade;

    if (grade === 'Read later') return 'text-purple-400';
    if (grade === 'Excellent') return 'text-blue-400';
    if (grade === 'Good') return 'text-green-400';
    if (grade === 'Average') return 'text-yellow-400';
    if (grade === 'Bad') return 'text-orange-400';
    if (grade === 'Disgusting') return 'text-red-400';
  });
</script>

<template>
  <div class="flex items-center space-x-6 mb-4 bg-neutral-700 rounded-lg border-2 border-amber-300 p-1 w-full text-1xl">
    
    <div class="w-32">
      <img :src="imageUrl" alt="title"  class="w-full h-full object-cover rounded-md">
    </div>

    <div class="flex flex-col flex-1">
      <p class="font-bold">TITLE</p>
      <h2>{{ bookProps.book.title }}</h2>
    </div>

    <div class="flex flex-col flex-1">
      <p class="font-bold">DESCRIPTION</p>
      <p>{{ bookProps.book.description }}</p>
    </div>

    <div class="flex flex-col flex-1">
      <p class="font-bold">GRADE</p>
      <p :class="gradeClass">{{ bookProps.book.grade.toUpperCase() }}</p>
    </div>

    <div class="flex flex-col space-y-6 mr-6">
      <button @click="" class="bg-blue-400 hover:bg-blue-500 text-white py-2 rounded cursor-pointer w-18 text-center">
        EDIT
      </button>
  
      <button @click="handleDelete" class="bg-red-400 hover:bg-red-500 text-white py-2 rounded cursor-pointer w-18 text-center">
        DELETE
      </button>
    </div>

  </div>
</template>
