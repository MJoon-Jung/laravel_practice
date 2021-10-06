<template>
  <form @submit.prevent="sendMessage">
    <input v-model="message" type="text" placeholder="message"/>
    <button type="submit">Submit</button>
  </form>
</template>

<script>
import { ref } from '@vue/reactivity';
import axios from 'axios';
    export default {
      props: ['room'],
      setup(props, { emit }) {
        const message = ref('');

        const sendMessage = () => {
          if(message.value == '') {
            alert('입력한 내용이 없습니다!!');
            return;
          }
          axios.post(`/api/rooms/${props.room.id}/messages`, { message: message.value })
            .then((res) => {
              message.value = '';
              emit('messagesent');
            })
            .catch((err) => console.error(err));
        }
        return { message, sendMessage };
      }
    }
</script>

<style>

</style>