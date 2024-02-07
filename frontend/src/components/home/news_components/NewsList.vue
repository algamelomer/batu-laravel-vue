<!-- components/NewsSection.vue -->
<template>
  <div class="flex flex-col min-[1222px]:flex-row w-full lg:w-11/12 justify-between">
    <!-- swiper -->
    <swiper :direction="direction" :slidesPerView="slidesPerView" :spaceBetween="30" :pagination="{
      type: 'progressbar',
    }" :autoplay="{
  delay: work,
  disableOnInteraction: disable,
}"
    :navigation="true"

:modules="modules" class=" w-full h-60 min-[1222px]:w-[30rem]  min-[1222px]:h-[45rem]">

      <!-- slider for cards -->
      <swiper-slide v-for="item in apiData" :key="item.id">
        <NewsCard :item="item" :numWordsToShow="numWordsToShow" :isActive="item.isActive" @handleClick="handleClick"
          :truncatedDescription="truncatedDescription" />
      </swiper-slide>

    </swiper>

    <!-- main card -->
    <MainCard :mainCard="mainCard" />
  </div>
</template>
  
<script>
import NewsCard from './NewsCard.vue';
import MainCard from './MainNewsCard.vue';
import { ref, onMounted } from 'vue';

import { Swiper, SwiperSlide } from 'swiper/vue';

import 'swiper/css';

import 'swiper/css/pagination';


import { Autoplay, Pagination, Navigation } from 'swiper/modules';

export default {
  components: {
    NewsCard,
    MainCard,
    Swiper,
    SwiperSlide,
  },
  props: {
    apiData: Array,
    mainCard: Object,
    numWordsToShow: Number,
    handleClick: Function,
    truncatedDescription: Function,
  },
  setup() {

const work= 5000;

const disable = true;

    const slidesPerView = ref(1);

    const direction = ref("horizontal")

    onMounted(() => {
      updateSlidesPerView();
      window.addEventListener('resize', updateSlidesPerView);
    });

    const updateSlidesPerView = () => {

      if (window.innerWidth < 901) {
        slidesPerView.value = 1;
      }

      else if (window.innerWidth < 1222) {
        slidesPerView.value = 2;
        direction.value = 'horizontal';
      }
      else {
        slidesPerView.value = 4;
        direction.value = 'vertical';
      }
    };

    return {
      modules: [Pagination ,Autoplay ,Navigation],
      slidesPerView,
      direction,
      work,
      disable

    };
  },
};
</script>

  
<style scoped>
.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;

  /* Center slide text vertically */
  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>

  