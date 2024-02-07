<template>
    <section class="bg-gray-50 dark:bg-gray-900 w-full">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white "
                        v-if="authStore.authUser">
                        Welcome to the Dashboard {{ authStore.authUser.email }}
                        <!-- id {{ authStore.authUser.id }}
                        role {{ authStore.authUser.role }} -->


                    </h1>
                    <!-- {{ authStore.user }} -->
                    <p class="text-gray-600 dark:text-gray-300">
                        This is a protected page. You can only access it if you are authenticated.
                    </p>
                    <button @click="authStore.handleLogout()"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Logout
                    </button>

                </div>
            </div>

        </div>

    </section>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue';

const authStore = ref(false)
const fetchData = async () => {
      try {
         authStore.value = await inject('user');
        //  console.log(authStore.value.user)
      } catch (error) {
        console.error('Error fetching data:', error);
      } finally {
      }
    };


    onMounted(() => {
      fetchData();
    });

</script>