<template>
    <div class="w-full flex flex-col items-center">
    <First_slide />
    <News />
</div>
</template>

<script>
import First_slide from '@/components/home/First_slide.vue';
import News from '@/components/home/News.vue';

export default{
    components:{
        First_slide,
        News
    }
}
</script>