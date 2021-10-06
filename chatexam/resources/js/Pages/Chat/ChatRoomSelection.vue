<template>
    <div>
        <div class="font-bold text-xl">
            {{ currentRoom.name }} 
            Chat Room
        </div>
        <select v-model="currentRoom" @change="$emit('roomChanged', currentRoom)">
            <option v-for="room in rooms" :key="room.id" :value="room">
                {{ room.name }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    props: ['rooms', 'currentRoom'],
}
</script>

<style>

</style>