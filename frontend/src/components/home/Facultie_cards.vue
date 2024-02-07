<template>
  <div v-if="apiData" class="w-full">
    <swiper :slidesPerView="slidesPerView" :centeredSlides="true" :spaceBetween="30" :grabCursor="true"
      :pagination="{ clickable: true, type: 'progressbar', el: null, }"
      :autoplay="{ delay: 5000, disableOnInteraction: true, }" :scrollbar="{ hide: false }" :loop="true"
      :modules="modules" class="mySwiper !h-max">

      <swiper-slide v-for="item in apiData" :key="item.id" class=" !h-72  flex flex-col relative w-full z-0">
        <div class="absolute w-full h-full -z-10" :style="'background-color:' + item.style.bg"></div>
        <div class="flex flex-row items-center justify-between pr-2">
          <div class="flex flex-col w-2/3 justify-between">
            <h3 class=" text-center text-xl font-semibold mb-4" :style="'color:' + item.style.title">{{ item.name }}</h3>
            <p class=" text-center text-xsm font-normal h-44 mb-2" :style="'color:' + item.style.content">{{
              item.description }}</p>
          </div>
          <div class=" w-24 h-24"><img :src="item.image" alt="" class=" w-full h-full object-cover"></div>
        </div>
        <div class=" rounded-3xl w-52 h-8 text-white" :style="'background-color:' + item.style.btn">Learn More</div>
      </swiper-slide>

    </swiper>
  </div>
</template>
<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { ref, onMounted, inject } from 'vue';
// import axios from 'axios';
import 'swiper/css';
import { Pagination, Scrollbar, Autoplay } from 'swiper/modules';

// js functions
import random_style from './facultie_cards_components/card_styler'

export default {
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {


    const apiData = ref();

    const slidesPerView = ref(1);
    // api request
    // const fetchData = async () => {
    //   try {
    //     const response = inject('department');
    //     // const response = await axios.get('/api/department');
    //     apiData.value = response;
    //     console.log(apiData.value)

    //   } catch (error) {
    //     console.error('Error fetching data:', error);
    //   }
    //   finally {

    //   }
    // };

    onMounted(() => {
      const response = inject('department');
      apiData.value = response.value;
      console.log(apiData.value)
      updateSlidesPerView();
      window.addEventListener('resize', updateSlidesPerView);
    });
    // slides per view (aka cards)
    const updateSlidesPerView = () => {
      if (window.innerWidth < 768) {
        slidesPerView.value = 1;
      } else if (window.innerWidth < 1024) {
        slidesPerView.value = 2;
      } else if (window.innerWidth < 1500) {
        slidesPerView.value = 3;
      }
      else {
        slidesPerView.value = 4;
      }
    };

    return {
      modules: [Pagination, Scrollbar, Autoplay],
      apiData,
      slidesPerView,
      random_style,
    };
  },
};
</script>
  
<style scoped>
.swiper-pagination {
  display: none !important;
  ;
}

.swiper-pagination,
.swiper-pagination-clickable,
.swiper-pagination-bullets,
.swiper-pagination-horizontal {
  display: none;
}

.swiper {
  width: 100%;
  height: 100%;
}

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
