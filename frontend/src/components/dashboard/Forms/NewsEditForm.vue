<template> 
    <form class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-700 m-auto"  @submit.prevent="authStore.handleNews(form)">
        <input type="text" class="text-black" placeholder="file" v-model="form.file" />
            <div class="px-6 py-4">
                  <input class="font-bold text-xl mb-2 text-black" type="text" placeholder="title" v-model="form.title" />
                   <input class="text-black text-base" type="text" placeholder="description" v-model="form.description" />

            </div>
            <button class="m-auto bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 border border-gray-500 rounded">Upload</button>

        </form>
</template>

<script setup>
import { ref, onMounted, inject,defineProps } from 'vue';
import { useAuthStore } from '@/stores/auth';
import axios from 'axios'


const props = defineProps({
  id: String 
});

const apiData = ref()

const form = ref({
    title: '',
    description: '',
    file: '', 
    user_id: '',
    id: ''
});

const handleFileChange = (event) => {
    const selectedFile = event.target.files[0];
    form.file = selectedFile; 
};

const authStore = useAuthStore();

const user =ref()

const fetchData = async () => {
    try {
        user.value = await inject('user');
        form.value.user_id = user.value.authUser.id; 
        const response = await axios.get('/api/posts/'+props.id);
        apiData.value = response.data
        form.value.title = apiData.value.title;
        form.value.file = apiData.value.file;
        form.value.description = apiData.value.description;
        form.value.id = apiData.value.id;
        } catch (error) {
        console.error('Error fetching data:', error);
    }
};



onMounted(() => {
    fetchData();
});
</script>