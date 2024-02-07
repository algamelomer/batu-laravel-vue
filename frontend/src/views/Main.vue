<template>
    <header class=" bg-primary_green h-24 p-5 flex items-center justify-between fixed w-full z-20 top-0">
      <div class=" w-40 sm:w-60 ">
        <img src="@/assets/logo.png" alt="logo" class="w-full">
      </div>
      <nav class=" text-white justify-between gap-8 lg:flex hidden">
        <router-link v-for="link in links" :key="link.id" :to="{ name: link.name }">{{ link.label }}</router-link>
        Drop Down
      </nav>
      <font-awesome-icon :icon="['fas', 'bars']" @click="toggle_sidebar" class="flex lg:hidden text-white w-5 h-5" />
    </header>
    <div class="mb-24"></div>
    <!-- content -->
    <div class="flex">
  
      <RouterView @click="hidesidebar"/>
      <Sidebar :class="{ 'hidden': isSidebarHidden }" :links="links"/>
      <!-- <div :class="{'ml-48':!isSidebarHidden}" class=" lg:hidden "></div> -->
    </div>
    <!-- footer -->
  </template>
  
  <script>
  import { RouterLink, RouterView } from 'vue-router'
  import { ref } from 'vue';
  import Sidebar from '@/components/header-footer/Sidebar.vue';
  
  export default {
    name: "Main",
    components: {
      Sidebar
    },
    provide() {
      return {
      };
    },
    setup() {
      const isSidebarHidden = ref(true);
  
      const toggle_sidebar = () => {
        isSidebarHidden.value = !isSidebarHidden.value;
      }
  
      const hidesidebar = () =>{
        isSidebarHidden.value = true;
      }
  
      let links = [
          { id: 0, name: 'home', label: 'Home' },
          { id: 1, name: 'about', label: 'About-us' },
          { id: 2, name: 'faculties', label: 'faculties' },
          { id: 3, name: 'contact', label: 'contact-us' },
        ]
  return { links, isSidebarHidden, toggle_sidebar, hidesidebar }
    },
    
  }
  </script>
  
  <style>
  .line{
    @apply w-12 h-[1px] bg-black rounded-md mt-5 mb-9
  }
  </style>
  