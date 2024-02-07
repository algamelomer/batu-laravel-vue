<template>
    <div v-if="apiData" class="w-full h-full">
        <first_slide />
        <swiper class="mt-8" />
        <Staff class="mt-8" />
    </div>
    <div v-else>
        <Loader />
    </div>
</template>

<script setup>
import first_slide from '@/components/faculties/first_slide.vue';
import swiper from '@/components/faculties/swiper.vue';
import Staff from '@/components/faculties/Staff.vue'

import Loader from '@/components/Loader.vue';
import { useRoute } from 'vue-router';

import axios from 'axios';
import { provide, ref, onMounted } from 'vue';
import filterData from '@/functions/filterData';
const route = useRoute();

let faculty = '';

const facultie = ref();

const department = ref();

const staff = ref();

const apiData = ref(false)

const fetchData = async () => {
    try {
        // facultie request
        let response = await axios.get('/api/faculty/' + faculty);
        facultie.value = response.data;

        // department request and filter them based on facultie
        response = await axios.get('/api/department');
        filterData(response.data.departments, department, "faculty_id", faculty);
        // staff request and filter them based on facultie
        response = await axios.get('/api/member');
        filterData(response.data.data, staff, "faculty_id", faculty);

    } catch (error) {
        console.error('Error fetching data:', error);
    } finally {
        apiData.value = true
    }

};

onMounted(() => {
    faculty = route.params.id
    fetchData();
});
provide('facultie', facultie);
provide('department', department);
provide('staff', staff);
</script>
