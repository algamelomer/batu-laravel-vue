<template>
    <div class="w-full h-96 overflow-hidden relative" v-for="items in facultie" :key="items.id">
        <img :src="items.image"
            alt="" class="w-full h-full object-cover blur-sm ">
        <div class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col w-full h-80 items-center justify-around md:flex-row md:h-full">
            <div class=" flex flex-col text-center items-center justify-center bg-[#F5F7FA] opacity-75 w-11/12 md:w-[422px] h-80">
                <h1 class=" text-main_title font-semibold text-4xl">{{ items.name }}</h1>
                <div class="line"></div>
                <p class=" text-[#7D7987] font-light text-lg text-center">{{ items.description }}</p>
            </div>

            <img src="@/assets/logo.png" class=" w-60 md:w-80 h-auto object-scale-down filter grayscale brightness-[4]" alt="">
        </div>
    </div>
</template>

<script setup>
import { inject } from 'vue'

const facultie = inject('facultie')


</script>