<template>
    <div class="grid grid-cols-1 lg:grid-cols-3 w-11/12 md:grid-cols-2 items-center">
        <div v-for="item in info" :key="item.id" class=" w-80 text-gray_text text-center items-center px-7 py-4  m-auto">
            <img :src="item.img" alt="" class="m-auto">
            <h3 class=" font-sans text-xl font-bold"><count-up :end-val="item.number"></count-up>{{ item.title }}</h3>
            <p class=" text-xs font-normal">{{ item.content }}</p>
        </div>
    </div>
</template>
  
<script>
export default {
    setup() {
        const info = [
            {
                "id": 1,
                "number": 40,
                "title": "Faculties",
                "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet justo ipsum. Sed accumsan quam vitae est varius",
                "img": "/images/icons/college.svg",
            },
            {
                "id": 2,
                "number": 5000,
                "title": "Students",
                "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet justo ipsum. Sed accumsan quam vitae est varius",
                "img": "/images/icons/students.svg",
            },
            {
                "id": 3,
                "number": 24,
                "title": "Student Clubs",
                "content": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet justo ipsum. Sed accumsan quam vitae est varius",
                "img": "/images/icons/student-clubs.svg",
            }
        ];

        return {
            info,
        };
    },
};
</script>
  