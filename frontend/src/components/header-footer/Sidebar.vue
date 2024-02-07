<template>
    <aside class="flex w-48 h-screen fixed right-0 z-30 flex-col space-y-2 border-r-2 border-gray-200 bg-white p-2 lg:hidden">
        <router-link v-for="link in links" :key="link.id" :to="{ name: link.name }">{{ link.label }}</router-link>
        </aside>
</template>
<script>
export default{
    name:"sidebar",
    props: ['links']
}
</script>
