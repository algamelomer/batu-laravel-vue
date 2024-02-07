<!-- components/MainCard.vue -->
<template>
    <div class="bg-card_gray w-full min-[1222px]:w-[45rem] xlg:w-[45rem] flex mt-6 min-[1222px]:mt-0 py-4 min-[1222px]:p-0 h-[45rem]">
      <div class="items-center flex flex-col gap-14 m-auto px-6">
        <div class="w-80 sm:w-96 h-64">
          <img :src="mainCard.img" alt="" class="w-full h-full object-cover">
        </div>
        <h2 class="text-primary_green text-center text-2xl font-semibold">{{ mainCard.title }}</h2>
        <p class="text-[#7d7987] text-center font-mulish text-xl font-light">{{ mainCard.content }}</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      mainCard: Object,
    },
  };
  </script>
  