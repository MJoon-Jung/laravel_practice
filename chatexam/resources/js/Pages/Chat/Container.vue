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
import { watch } from '@vue/runtime-core';
import { useStore } from 'vuex';
  export default {
    components: {
        AppLayout,
        MessageContainer,
        InputMessage,
        RoomList,
        ChatRoomSelection,
    },
    setup() {
        const store = useStore();
        const chatRooms = ref([]);
        const currentRoom = ref({});
        const messages = ref([]);
        const loadMessages = (id) => store.dispatch("loadMessagesInfo", id);
        
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

        // watch(currentRoom, (val, oldVal) => {
        //     console.log('바뀜')
        //     if (oldVal?.id) {
        //         disconnect(oldVal);
        //     }
        //     connect();
        // });

        // const disconnect = (room) => {
        //     window.Echo.leave(`chat.${room.id}`);
        // }
        // const connect = () => {
        //     console.log('누군가가 입장');
        //     loadMessagesByRoom();
        //     window.Echo.private(`chat.${currentRoom.value.id}`)
        //         .listen('.message.new', (e) => {
        //             loadMessagesByRoom();
        //         })  
        // }

        store.dispatch("loadRoomInfo");
        return { chatRooms, currentRoom, messages, setCurrentRoom, loadMessagesByRoom, connect, disconnect };
    }
  }
</script>

<style>
.layout {
    display: flex;
    justify-content: space-around;
}
</style>