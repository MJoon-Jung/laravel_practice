<template>
    <app-layout title="Dashboard">
        <div class="text-xl bg-red-600">수강 과목 정보</div>
        <div>수강 과목: {{ subject.name }} 학점: {{ subject.grade }}</div>
        <div>
            <div v-for="user in subject.users" :key="user.id">
                <div>{{ user.id }}</div>
                <div>{{ user.name }}</div>
                <div>{{ user.email }}</div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import {defineComponent} from "vue";
import AppLayout from "../../Layouts/AppLayout";
export default defineComponent({
    components: {AppLayout},
    props: ['subject'],
    setup(props) {
        return { }
    }
})
</script>

<style scoped>

</style>
