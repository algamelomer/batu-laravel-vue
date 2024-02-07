<template>
	<div class="mr-20 h-full lg:mr-80 "></div>
	<div :class="{ 'sidebar': isSidebarHidden }"
		class="flex flex-col items-center w-20 lg:w-80 h-screen fixed left-0 overflow-hidden text-gray-400 dark:bg-gray-900 border-r border-gray-700">
		<a class="flex items-center w-full mt-3" href="#">
			<div class="w-36">
				<img src="@/assets/logo.png" alt="" class="w-full h-full">
			</div>
			<span class="ml-2 text-md font-bold hidden lg:flex">Batu dashboard</span>
		</a>
		<div class="flex flex-col items-center w-full mt-2 border-t border-gray-700"></div>
		<div v-for="link in links" :key="link.id" class="lg:w-full items" v-if="authStore">
			<div v-if="(link.label == 'users')&&(authStore.authUser.role !== 'superAdmin')"></div>
			<div v-else>
				<router-link :to="{ name: link.name }"
					class="flex items-center w-full h-12 px-3 mt-2 rounded hover:bg-gray-700 hover:text-gray-300 gap-3"><font-awesome-icon
						:icon="link.icon" /><span class=" hidden lg:flex">{{ link.label }}</span></router-link>
				<div class="flex flex-col items-center w-full mt-2 border-t border-gray-700"></div>
			</div>
		</div>
		<button @click="handleclick" class=" lg:hidden flex" :class="{ 'rotate-180': isSidebarHidden }"><font-awesome-icon
				icon="arrow-right" /></button>
	</div>

	<!-- </body> -->
</template>
<script setup>
import { ref, onMounted, inject } from 'vue';
let links = [
	{ id: 0, name: 'DashboardHome', label: 'dashboard', icon: "house" },
	{ id: 1, name: 'DashboardUsers', label: 'users', icon: "users" },
	{ id: 2, name: 'DashboardFaculties', label: 'faculties', icon: "building-columns" },
	{ id: 3, name: 'DashboardDepartments', label: 'departments', icon: "school" },
	{ id: 4, name: 'DashboardNews', label: 'News', icon: "newspaper" },
	{ id: 5, name: 'DashboardArticle', label: 'Article', icon: "book" },
	{ id: 6, name: 'DashboardLetter', label: 'Letter', icon: "scroll" },

]

const isSidebarHidden = ref(false)
const handleclick = () => {
	isSidebarHidden.value = !isSidebarHidden.value
}

const authStore = ref(false)
const fetchData = async () => {
	try {
		authStore.value = await inject('user');
	} catch (error) {
		console.error('Error fetching data:', error);
	} finally {
	}
};


onMounted(() => {
	fetchData();
});
</script>


<style scoped>
.sidebar {
	@apply w-80
}

.sidebar span {
	@apply flex
}

.sidebar .items {
	@apply w-full
}
</style>