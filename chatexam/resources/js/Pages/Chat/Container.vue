<template>
    <app-layout>
        <div class="layout">
            <message-container v-bind:messages="messages" />
            <input-message/>
            <room-list v-bind:rooms="chatRooms" />
        </div>
    </app-layout>
</template>

<script>
import axios from 'axios';
import AppLayout from '@/Layouts/AppLayout';
import MessageContainer from '@/Pages/Chat/MessageContainer';
import InputMessage from '@/Pages/Chat/InputMessage';
import RoomList from '@/Pages/Chat/RoomList';
  export default {
    components: {
        AppLayout,
        MessageContainer,
        InputMessage,
        RoomList,
    },
    data() {
        return {
            chatRooms: [],
            currentRoom: null,
            messages: [],
        }
    },
    methods: {
        loadRooms() {
            axios.get('api/rooms')
                .then((res) => {
                    this.chatRooms = res.data;
                    this.setCurrentRoom(res.data[0].id);
                })
                .catch((err) => console.error(err));
        },
        setCurrentRoom(room) {
            this.currentRoom = room;
            this.loadMessagesByRoom();
        },
        loadMessagesByRoom() {
            axios.get(`api/rooms/${this.currentRoom}/messages`)
                .then((res) => {
                    this.messages = res.data;
                })
                .catch((err) => console.error(err));
        },
    },
    created() {
        this.loadRooms();
    },
  }
</script>

<style>
.layout {
    display: flex;
    justify-content: space-around;
}
</style>