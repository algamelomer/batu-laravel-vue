<template>
  <h1 class=" text-main_title font-mulish text-5xl font-bold mt-5">Recent News</h1>
  <div class="line"></div>

  <div v-for="items in apiData" :key="items.id">
    <p v-if="items.main_title" class=" max-w-[53rem] text-center text-[#ccd2e9] text-lg font-medium mb-9">{{
      items.main_title }}</p>
  </div>
  <div class="flex flex-col min-[1222px]:flex-row lg:w-11/12 justify-between">
    <div class=" grid grid-cols-1 items-center md:grid-cols-2  min-[1222px]:grid-cols-1 gap-4 ">
      <!-- cards -->
      <div v-for="items in apiCard" :key="items.id">
        <div v-if="items.title && items.img" :class="{ 'active-card': items.isActive ,}"
          class="m-auto card w-96 h-32 bg-card_gray cursor-pointer flex transition duration-1000 ease-in-out " 
          @click="handleclick(items)">
          <div class=" w-1/3 h-full">
            <img :src="items.img" alt="" class=" w-full h-full object-cover">
          </div>
          <div class="w-2/3 flex items-center px-3">
            <div>
              <h3 class=" text-main_title text-center text-lg font-semibold">{{ items.title }}</h3>
              <p class=" pr-2 text-[#7d7987] text-center text-xs">{{ items.content }}</p>
            </div>
            <div class="w-8 h-8">
              <span
                class=" w-8 h-8 rounded-full bg-main_title flex items-center text-center text-white justify-center"><font-awesome-icon
                  :icon="['fas', 'angle-up']" rotation=90 /></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- main card -->
    <div class=" bg-card_gray lg:min-w-[35rem] flex mt-6 min-[1222px]:mt-0 pb-4 md:p-0">
      <div class="items-center flex flex-col gap-14 m-auto px-6">
        <div class=" w-80 sm:w-96 h-64">
          <img :src="mainCard.img" alt="" class="w-full h-full object-cover">
        </div>
        <h2 class=" text-primary_green text-center text-2xl font-semibold">{{ mainCard.title }}</h2>
        <p class=" text-[#7d7987] text-center font-mulish text-xl font-light">{{ mainCard.content }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, inject } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const mainCard = ref({ title: '', content: '', img: '' });

    const api = inject('api');

    const apiData = ref();

    const apiCard = ref();

    let counter = 1;

    let isPaused = false;

    let isActive = ref()


    const handleclick = (items) => {
      mainCard.value.title = items.title;
      mainCard.value.content = items.content;
      mainCard.value.img = items.img;
      mainCard.value.id = items.id;
      activecard()
      isPaused = true;
      setTimeout(() => {
        isPaused = false;
      }, 5000);
    }

    const autoChangeData = () => {
      if (apiData.value && apiData.value.length > 0) {
        const initialItem = apiData.value[1];
        mainCard.value.title = initialItem.title;
        mainCard.value.content = initialItem.content;
        mainCard.value.img = initialItem.img;
        mainCard.value.id = initialItem.id;
        activecard()
      }
      setInterval(() => {
        if (apiCard.value.length > 0 && !isPaused) {
          const nextItem = apiCard.value[counter];
          mainCard.value.title = nextItem.title;
          mainCard.value.content = nextItem.content;
          mainCard.value.img = nextItem.img;
          mainCard.value.id = nextItem.id;
          counter = (counter + 1) % apiCard.value.length;
          activecard()
        }
      }, 5000);
    };

    const activecard = () => {
      const prevActiveCard = apiCard.value.find(card => card.isActive);
      if (prevActiveCard) {
        prevActiveCard.isActive = false;
      }
      const activeCard = apiCard.value.find(card => card.id === mainCard.value.id);
      if (activeCard) {
        activeCard.isActive = true;
      }
    }

    const fetchData = async () => {
      try {
        const response = await axios.get(api + 'recent-news');
        apiData.value = response.data;
        apiCard.value = apiData.value.slice(1).map(item => ({ ...item, isActive: false }));
      } catch (error) {
        console.error('Error fetching data:', error);
      }
      finally {
        autoChangeData();
      }
    };

    onMounted(() => {
      fetchData();
    });

    return {
      apiData,
      mainCard,
      handleclick,
      apiCard,
      isActive
    };
  },
};
</script>

<style>
.active-card {
  @apply !bg-[#2d7c7f] 
}

.active-card h3 {
  @apply text-primary_green
}

.active-card p {
  @apply text-[#99d9db]
}
.card:hover { @apply active-card }


</style>