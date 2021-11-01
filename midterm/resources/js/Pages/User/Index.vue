<template>
    <app-layout title="Dashboard">
            <div>
                <div v-for="subject in info.subjects" :key="subject.id">
                    <div>이름: {{ subject.name }}</div>
                    <div>학점: {{ subject.grade }}</div>
                    <div>수강생: {{ subject.users.length }}</div>
                    <Link :href="route('user.show', subject)" method="get">수강생 리스트 보기</Link>
                </div>
            </div>
    </app-layout>
</template>

<script>
import {defineComponent} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/inertia-vue3'
export default defineComponent({
    components: {
      AppLayout,
    Link,
    },
    props: ['info'],
    setup(props){
    },
})
</script>

<style scoped>

</style>
