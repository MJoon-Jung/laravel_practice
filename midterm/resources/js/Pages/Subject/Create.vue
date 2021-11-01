<template>
    <app-layout title="Dashboard">
        <form @submit.prevent="form.post('/subjects')">
            <label>과목명</label>
            <input type="text" v-model="form.name">
            <label>학점</label>
            <input type="text" v-model="form.grade">
            <label>설명</label>
            <input type="text" v-model="form.description">
            <button type="submit" :disabled="form.processing">등록</button>
        </form>
    </app-layout>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
export default defineComponent({
    components: {
        AppLayout,
    },
    setup () {
        const form = useForm({
            name: null,
            grade: null,
            description: null,
        })
        return { form }
    }
})
</script>

<style>
</style>
