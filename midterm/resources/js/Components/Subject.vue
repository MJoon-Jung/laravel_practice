<template>
    <div>
        <div>이름 : {{subject.name}}</div>
        <div>학점 : {{subject.grade}}</div>
        <Link :href="route('subject.show', subject)" method="get">자세히 보기</Link>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import { Link } from '@inertiajs/inertia-vue3'
export default defineComponent({
    props: ['subject'],
    components: {
        Link,
    },
    setup(){

    },
})
</script>

<style scoped>

</style>
