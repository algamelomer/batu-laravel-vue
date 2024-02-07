<template>
    <form class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-700 m-auto"
        @submit.prevent="authStore.handleArticle(form)">
        <img v-if="form.fileUrl" :src="form.fileUrl" alt="Uploaded Photo" class="mx-auto my-4 max-w-full h-auto" />
        <input type="file" @change="handleFileChange" />
        <div class="px-6 py-4">
            <input class="font-bold text-xl mb-2" type="text" placeholder="title" v-model="form.title" />
            <input class="text-white text-base" type="text" placeholder="description" v-model="form.description" />

        </div>
        <button
            class="m-auto bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 border border-gray-500 rounded">Upload</button>

    </form>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue';
import { useAuthStore } from '@/stores/auth';

const form = ref({
    title: '',
    description: '',
    file: '',
    user_id: '',
    fileUrl: null 
});

const handleFileChange = (event) => {
    const file = event.target.files[0]; 
    form.value.file = file;
    form.value.fileUrl = URL.createObjectURL(file);
};



const authStore = useAuthStore();

const user = ref()

const fetchData = async () => {
    try {
        user.value = await inject('user');
        form.value.user_id = user.value.authUser.id;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

onMounted(() => {
    fetchData();
});
</script>