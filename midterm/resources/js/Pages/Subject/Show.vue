<template>
    <app-layout title="Dashboard">
        <div>번호: {{ subject.id }}</div>
        <div>이름: {{ subject.name }}</div>
        <div>설명: {{ subject.description }}</div>
        <div>학점: {{ subject.grade }}</div>
        <Link :href="route('subject.edit', subject)" method="get">수정</Link>
        <Link :href="route('subject.destroy', subject)" method="delete">삭제</Link>
        <button v-if="!isApply" @click="apply(subject.id)">수강 신청</button>
        <button v-else @click="unapply(subject.id)">수강 취소</button>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'
import {Inertia} from "@inertiajs/inertia";
export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: ['subject', 'isApply'],
    setup (props) {
        console.log(props.isApply);
        const apply = (id) => {
            axios.patch(`/subjects/${id}/apply`)
                .then(() => Inertia.reload({ only: ['isApply'] }))
                .catch((err)=> console.error(err))
        }
        const unapply = (id) => {
            axios.delete(`/subjects/${id}/apply`)
                .then(() => Inertia.reload({ only: ['isApply'] }))
                .catch((err)=> console.error(err))
        }
        return { apply, unapply }
    }
})
</script>

<style>
</style>
