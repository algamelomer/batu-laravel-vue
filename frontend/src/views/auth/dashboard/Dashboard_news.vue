<template>
    <div class="flex justify-around">
        <h1>Want to add news?</h1>
        <button @click="handleClick"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 border border-gray-500 rounded">Add</button>
    </div>
    <div class="flex flex-col items-center w-full mt-2 border-t border-gray-700"></div>

    <div class="grid gap-5 grid-cols-1 lg:grid-cols-2 justify-center m-auto w-full" v-if="apiData">
        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-700 m-auto" v-for="items in apiData" :key="items.id">
            <img class="w-full" :src="items.file" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ items.title }}</div>
                <p class="text-white text-base">
                    {{ items.description }}
                </p>
            </div>
            <div class="px-6 pt-4 pb-2 flex justify-between">
                <button @click="handleEdit(items.id)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-500 rounded">edit</button>
                <button @click="DeleteItem(items.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-500 rounded">delete</button>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { useRouter} from 'vue-router';
import { onMounted, ref } from 'vue'
import axios from 'axios';
import filterData from '@/functions/filterData.js';
import { useAuthStore } from '@/stores/auth';

const authstore = useAuthStore()

const router = useRouter();

const apiData = ref(false)

const fetchData = async () => {
    try {
        const response = await axios.get('/api/posts');
        filterData(response.data, apiData,"type","news");
    } catch (error) {
        console.error('Error fetching data:', error);
    }
    finally {
       
    }
};

onMounted(() => {
    fetchData();
});

const handleClick = () => {
    router.push({ name: 'DashboardUpload', params: { category: 'news' } });
};
const handleEdit = (id) =>{
    router.push({ name: 'DashboardEdit', params: { category: 'news' ,id: id} });
}


const DeleteItem = async (id) => {
    await authstore.handleNewsDelete(id)
    fetchData();
}
</script>
  