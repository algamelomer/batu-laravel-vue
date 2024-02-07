<template>
    <div class="flex flex-col items-center justify-between w-11/12 mx-auto py-8 bg-card_gray">
<div>
    <h1 class=" font-bold font-mulish text-4xl text-main_title">Our Main Majors</h1>
    <div class="line mx-auto my-6 h-[2px]"></div>
</div>
    
        <!-- Pagination -->
        <swiper :pagination="false" :modules="modules" :slides-per-view="pang_view" :freeMode="true" class="pagination w-10/12 bg-white"
            @swiper="onSwiper" @slideChange="onSlideChange">
            <swiper-slide v-for="(item, index) in department" :key="index">
                <span :class="{ active: index === currentIndex }" @click="goToSlide(index)">{{ item.name }}</span>
            </swiper-slide>
        </swiper>

        <!-- Swiper for the content -->
        <div class="w-full">
        <swiper :pagination="false" :modules="modules" :slides-per-view="slides" :freeMode="true" :space-between="25" :centeredSlides="true"
             class="mySwiper facultie-swiper" @swiper="onSwiper" @slideChange="onSlideChange">
            <swiper-slide v-for="item in department" :key="item.id" class="swiper-slide-item cursor-pointer flex flex-col bg-[#2D7C7F] pb-4">
                <div class=" flex items-center justify-around px-4 py-6">
                    <div class="text-start w-10/12">
                        <h1 class="text-primary_green font-semibold text-xl">{{ item.name }}</h1>
                        <div class="line h-[2px]"></div>
                        <p class="font-normal text-xs text-par">{{ item.description }}</p>
                    </div>
                    <div class="w-28 h-32">
                        <img :src="item.image" alt="" class="w-full object-cover">
                    </div>
                </div>
                <div class="flex justify-around items-center text-white bg-primary_green px-5 py-2 rounded-3xl gap-4">
                    <h3>Read More</h3>
                    <font-awesome-icon class="transform rotate-90 text-white" :icon="['fas', 'angle-up']" />
                </div>
            </swiper-slide>
        </swiper>
    </div></div>
</template>
  
<script setup>
import { ref, onMounted, onUnmounted, watchEffect } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';
import { Pagination, FreeMode } from 'swiper/modules';
import { inject } from 'vue';

const department = inject('department');
const currentIndex = ref(0);
const swiperRef = ref(null);
const slides = ref()
const pang_view = ref()

const modules = [Pagination, FreeMode];

const goToSlide = (index) => {
    currentIndex.value = index;
    if (swiperRef.value && swiperRef.value.slideTo) {
        swiperRef.value.slideTo(index);
    }
};

const onSwiper = (swiper) => {
    swiperRef.value = swiper;
};

const onSlideChange = () => {
    if (swiperRef.value && swiperRef.value.activeIndex !== currentIndex.value) {
        currentIndex.value = swiperRef.value.activeIndex;
    }
};
const handleResize = () => {
    if (window.innerWidth > 1300) {
        slides.value = 3;
        pang_view.value = 6;
    }
    else if (window.innerWidth > 733) {
        slides.value = 2;
        pang_view.value = 4;
    }
    else {
        slides.value = 1;
        pang_view.value = 3;
    }
}


onMounted(() => {
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});
watchEffect(() => {
    handleResize(); 
});
</script>
  
<style scoped>
.pagination {
    @apply flex justify-between border-[1px] border-primary_green h-[60px] rounded-[60px] mb-8
}

.pagination span {
    @apply cursor-pointer border-transparent rounded-[60px] w-full text-center flex py-1 px-2 items-center justify-center h-full
}

.pagination span.active {
    @apply bg-primary_green text-white
}

</style>
  