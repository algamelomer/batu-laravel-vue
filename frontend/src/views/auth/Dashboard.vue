<!-- Dashboard.vue -->
<template>
  <!-- <section class="bg-gray-50 dark:bg-gray-900 w-full">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
      <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
            v-if="authStore.authUser">
            Welcome to the Dashboard {{ authStore.authUser.email }}
            id {{ authStore.authUser.id }}
            role {{ authStore.authUser.role }}
            

          </h1>
          <p class="text-gray-600 dark:text-gray-300">
            This is a protected page. You can only access it if you are authenticated.
          </p>
          <button @click="authStore.handleLogout()"
            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Logout
          </button>
          <router-link :to="{ name: 'Login' }">DashboardHome</router-link>
          <RouterView />

        </div>
      </div>

    </div>

  </section> -->
  <!-- <RouterView /> -->
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