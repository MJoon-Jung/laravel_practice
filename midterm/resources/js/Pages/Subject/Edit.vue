<template>
    <app-layout title="Dashboard">
        <form @submit.prevent="form.patch(`/subjects/${subject.id}`)">
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
import {useForm} from '@inertiajs/inertia-vue3'
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

export default defineComponent({
    components: {
        AppLayout,
    },
    props: ["subject"],
    setup(props) {
        const form = useForm({
            name: props.subject.name,
            grade: props.subject.grade,
            description: props.subject.description,
        })
        return {form}
    }
})
</script>

<style>
</style>
