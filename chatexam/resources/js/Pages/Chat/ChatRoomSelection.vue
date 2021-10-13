<template>
    <div>
        <div class="font-bold text-xl">
            {{ currentRoom.name }} 
            Chat Room
        </div>
        <select v-model="selected" @change="$emit('roomChanged', selected)">
            <option v-for="room in rooms" :key="room.id" :value="room" >
                {{ room.name }}
            </option>
        </select>
    </div>
</template>

<script>
import { ref } from '@vue/reactivity';
export default {
    props: ['rooms', 'currentRoom'],
    setup(props) {
        const selected = ref(props.currentRoom);

        return { selected };
    }
}
</script>

<style>

</style>