<template>
    <app-layout>
        <template #header>
            <chat-room-selection 
              :rooms="chatRooms"
              :currentRoom="currentRoom"
              v-on:roomChanged="setCurrentRoom($event)"
            />
        </template>
        <div class="layout">
            <message-container v-bind:messages="messages" />
            <input-message v-bind:room="currentRoom" v-on:messagesent="loadMessagesByRoom"/>
            <!-- <room-list v-bind:rooms="chatRooms" /> -->
        </div>
    </app-layout>
</template>

<script>
import axios from 'axios';
import AppLayout from '@/Layouts/AppLayout';
import MessageContainer from '@/Pages/Chat/MessageContainer';
import InputMessage from '@/Pages/Chat/InputMessage';
import RoomList from '@/Pages/Chat/RoomList';
import { ref } from '@vue/reactivity';
import ChatRoomSelection from './ChatRoomSelection';
  export default {
    components: {
        AppLayout,
        MessageContainer,
        InputMessage,
        RoomList,
        ChatRoomSelection,
    },
    setup() {
        const chatRooms = ref([]);
        const currentRoom = ref({});
        const messages = ref([]);

        const setCurrentRoom = (room) => {
            currentRoom.value = room;
            loadMessagesByRoom();
        }

        const loadMessagesByRoom = () => {
            axios.get(`api/rooms/${currentRoom.value.id}/messages`)
                .then((res) => {
                    messages.value = res.data;
                })
                .catch((err) => console.error(err));
        }

        axios.get('api/rooms')
            .then((res) => {
                chatRooms.value = res.data;
                setCurrentRoom(res.data[0]);
            })
            .catch((err) => console.error(err));

        return { chatRooms, currentRoom, messages, setCurrentRoom, loadMessagesByRoom };
    }
  }
</script>

<style>
.layout {
    display: flex;
    justify-content: space-around;
}
</style>