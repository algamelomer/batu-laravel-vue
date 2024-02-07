<!-- views/NewsPage.vue -->
<template>
  <div v-if="apiData" class="w-full">
    <div class="flex flex-col items-center w-full">
      <h1 class="text-main_title font-mulish text-5xl font-bold mb-4">Recent News</h1>
      <div class="line mb-8"></div>
      <p class="max-w-[53rem] text-center text-[#ccd2e9] text-lg font-medium mb-9">{{ main_title }}</p>
      <NewsSection :apiData="apiData" :mainCard="mainCard" :numWordsToShow="numWordsToShow" :handleClick="handleClick"
        :truncatedDescription="truncatedDescription" />
    </div>
  </div>
  <div v-else>loading...</div>
</template>
<script>
import { ref, onMounted, inject } from 'vue';
// import axios from 'axios';
import NewsSection from './news_components/NewsList.vue';

// js functions
import autoChangeData from './news_components/js/autoChangeData'
import clickhandler from './news_components/js/clickhandler'
import truncatedDescription from './news_components/js/truncatedDescription'
import isActive from './news_components/js/isActive'
import filterData from '@/functions/filterData.js';


export default {
  components: {
    NewsSection,
  },
  setup() {
    const mainCard = ref({ title: '', content: '', img: '' });
    const apiData = ref();
    let counter = 1;
    let isPaused = false;
    const main_title = ref("Explore our latest university news. Stay informed about breakthroughs, events, and achievements shaping our dynamic academic community. Discover more.");
    const numWordsToShow = 15;

    const handleClick = (items) => {
      clickhandler(apiData, mainCard, isPaused, items)
    };


    const activeCard = () => {
      isActive(apiData, mainCard)
    };

    const fetchData = async () => {
      try {
        const response = inject('posts');
        filterData(response.value, apiData,"type","news");
      } catch (error) {
        console.error('Error fetching data:', error);
      } finally {
        autoChangeData(apiData, mainCard, counter, isPaused, activeCard);
      }
    };


    onMounted(() => {
      fetchData();
    });

    return {
      apiData,
      mainCard,
      numWordsToShow,
      handleClick,
      main_title,
      truncatedDescription,
    };
  },
};
</script>
