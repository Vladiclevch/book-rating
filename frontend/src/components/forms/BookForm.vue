<script setup>
  const bookProps = defineProps({
    book: {
      type: Object,
      required: true
    }
  });

 
</script>

<template>
  <div>

    <div>

    </div>

    <div>
      <img :src="imageUrl" :alt="book.title">
    </div>

    <div>
      <h2>{{ bookProps.book.title }}</h2>
    </div>

    <div>
      <p>{{ bookProps.book.grade }}</p>
    </div>

    <div>
      <p>{{ bookProps.book.description }}</p>
    </div>

    <div>
      <button>
        EDIT
      </button>
  
      <button>
        DELETE
      </button>
    </div>

  </div>
</template>
