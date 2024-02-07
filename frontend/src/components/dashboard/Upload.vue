<template>
    <div>
      <h1>Add {{ category }}</h1>
      <component :is="getUploadFormComponent(category)" />
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  import NewsUploadForm from './Forms/NewsUploadForm.vue';
  import DefaultUploadForm from './Forms/DefaultUploadForm.vue'; // Import the DefaultUploadForm component
  
  const category = ref('');
  
  const route = useRoute();
  onMounted(() => {
    category.value = route.params.category;
  });
  
  const getUploadFormComponent = (category) => {
    switch (category.toLowerCase()) {
      case 'news':
        return NewsUploadForm;
      default:
        return DefaultUploadForm;
    }
  };
  </script>
  