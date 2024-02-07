<template>
  <div v-if="authorized" class="dark:bg-gray-900
dark:bg-gray-800 dark:border-gray-700
dark:text-white min-h-screen">
    <div class="w-full h-full flex">


      <Sidebar />
      <div class="flex flex-col h-full w-full">
        <!-- Component End  -->
        <router-view></router-view>
      </div>
    </div>
  </div>
  <div v-else><Loader></Loader></div>
</template>
  
<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { onMounted, provide, ref } from 'vue';
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';
import Sidebar from '../../components/dashboard/Sidebar.vue';
import Loader from '@/components/Loader.vue'

const authorized = ref(false)

const authStore = useAuthStore();
const router = useRouter();

onMounted(async () => {
  try {
    await authStore.getUser();
    if (!authStore.user) {
      router.push('/login');
    }
    else{
      authorized.value = true 
    }
  } catch (error) {
    console.error('Error fetching user data:', error.status);
  } finally {
  }


});
provide('user', authStore);



</script>