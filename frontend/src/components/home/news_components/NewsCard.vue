<!-- components/NewsCard.vue -->
<template>
    <div :class="{ 'active-card': isActive }" class="m-auto card w-96 h-44 bg-card_gray cursor-pointer flex transition duration-1000 ease-in-out " @click="$emit('handleClick', item)">
      <div class="w-1/3 h-full">
        <img :src="item.file" alt="" class="w-full h-full object-cover">
      </div>
      <div class="w-2/3 flex items-center px-3">
        <div>
          <h3 class="text-main_title text-start text-lg font-semibold">{{ item.title }}</h3>
          <p class="pr-2 text-[#7d7987] text-start text-xs">{{ truncatedDescription(item.description, numWordsToShow) }}</p>
        </div>
        <div class="w-8 h-8">
          <span class="w-8 h-8 rounded-full bg-main_title flex items-center text-center text-white justify-center">
            <font-awesome-icon :icon="['fas', 'angle-up']" rotation="90" />
          </span>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      item: Object,
      isActive: Boolean,
      handleClick: Function,
      truncatedDescription: Function,
      numWordsToShow:Number,
    },
  };
  </script>
  
  <style scoped>
  .active-card {
    @apply !bg-[#2d7c7f]
  }
  
  .active-card h3 {
    @apply text-primary_green
  }
  
  .active-card p {
    @apply text-[#99d9db]
  }
  
  .card:hover {
    @apply active-card
  }
  </style>
  