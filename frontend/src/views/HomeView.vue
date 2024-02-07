<template>
    <div v-if="apiData" class="w-full flex flex-col items-center">
        <First_slide class="mb-5" />
        <News />
        <Facultie_cards class=" mt-12 w-full" />
        <Basic_info class=" mt-12" />
    </div>
    <div v-else>
        <Loader />
    </div>
</template>

<script setup>
import { provide, ref, onMounted } from 'vue';
import Basic_info from '@/components/home/Basic_info.vue';
import Facultie_cards from '@/components/home/Facultie_cards.vue';
import First_slide from '@/components/home/First_slide.vue';
import News from '@/components/home/News.vue';
import Loader from '@/components/Loader.vue';
import axios from 'axios';
// import moduleName from '@/components/';

import random_style from '@/components/home/facultie_cards_components/card_styler'

const department = ref();

const posts = ref();

const apiData = ref(false)

const fetchData = async () => {
    try {
        let response = await axios.get('/api/department');
        department.value = response.data.departments;
        response = await axios.get('/api/posts');
        posts.value = response.data
    } catch (error) {
        console.error('Error fetching data:', error);
    }
    finally {
        department.value.forEach(item => {
            if (item.id) {
                item.style = random_style();
            }
        });
        apiData.value=true
    }
};

provide('department', department);
provide('posts', posts);

onMounted(() => {
    fetchData();
});

// export default {
//     components: {
//         First_slide,
//         News,
//         Facultie_cards,
//         Basic_info
//     }
// }
</script>