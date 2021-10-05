<template>
    <ul>
        <li><strong>채팅방</strong></li>
        <li v-for="room in rooms" v-bind:key="room.id">
            <button>
                {{ room.name }}
            </button>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['rooms'],
    }
</script>

<style>

</style>