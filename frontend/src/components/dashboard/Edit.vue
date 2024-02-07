<template>
    <div>
      <h1>Add {{ category }}</h1>
      <component :is="getUploadFormComponent(category)" :id="id"/>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  import NewsEditForm from './Forms/NewsEditForm.vue';
  import DefaultUploadForm from './Forms/DefaultUploadForm.vue'; 
  
  const category = ref('');
  const id = ref('');

  
  const route = useRoute();
  onMounted(() => {
    category.value = route.params.category;
    id.value = route.params.id;
  });

  
  const getUploadFormComponent = (category) => {
    switch (category.toLowerCase()) {
      case 'news':
        return NewsEditForm;
      default:
        return DefaultUploadForm;
    }
  };

  </script>
  