<template>
    <app-layout title="Dashboard">
        <div v-if="subjects.data.length">
            <div>
                <div v-for="subject in subjects.data" :key="subject.id">
                    <Subject :subject="subject" />
                </div>
            </div>
            <pagination class="mt-6" :links="subjects.links" />
        </div>
        <div v-else>
            등록된 과목이 없습니다.
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Subject from "../../Components/Subject";
import Pagination from "./Pagination";
export default defineComponent({
    components: {
        Subject,
        AppLayout,
        Pagination,
    },
    props: ['subjects'],
    setup () {
        return {  }
    }
})
</script>

<style>
</style>
