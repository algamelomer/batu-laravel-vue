<template>
    <div class="flex flex-col items-center w-11/12 mx-auto py-8 bg-card_gray justify-around gap-5">
        <div>
            <h1 class=" text-center font-bold font-mulish text-4xl text-main_title">Our Staff</h1>
            <div class="line mx-auto my-6 h-[2px]"></div>
            <p class=" text[#ccd2e9] text-center text-xl ">At Industry and Energy College, our dedicated staff comprises
                industry experts and passionate educators committed to nurturing talent, fostering innovation, and shaping
                future leaders.</p>
        </div>
        <swiper :slidesPerView="slides" :spaceBetween="30" :centeredSlides="true" :loop="true" :autoplay="{
            delay: 2500,
            disableOnInteraction: true,
        }" :freeMode="true" :pagination="false" :modules="modules" class="mySwiper flex flex-col w-11/12">
            <swiper-slide v-for="items in staff" :key="items.id" class="flex flex-col text-center items-center relative cursor-pointer">
                <img :src="items.image" alt="">
                <div class="flex flex-col items-center absolute w-full bottom-0 bg-white opacity-85 justify-around h-2/6">
                    <h3 class=" text-main_title font-bold text-xl ">{{ items.name }}</h3>
                    <div class=" w-7 h-7 bg-main_title transform rotate-90 text-white rounded-full">
                        <font-awesome-icon :icon="['fas', 'angle-up']" />
                    </div>
                </div>
            </swiper-slide>

        </swiper>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watchEffect } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/pagination';
import { FreeMode, Pagination, Autoplay } from 'swiper/modules';
import { inject } from 'vue'

const slides = ref()
const handleResize = () => {
    if (window.innerWidth > 1300) {
        slides.value = 3;
    }
    else if (window.innerWidth > 733) {
        slides.value = 2;
    }
    else {
        slides.value = 1;
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
const modules = [FreeMode, Pagination, Autoplay]
const staff = inject('staff')
</script>

<style>
.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;

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