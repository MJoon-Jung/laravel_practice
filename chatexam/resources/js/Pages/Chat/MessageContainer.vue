<template>
  <div class="h-96 w-full">
      <div class="p-2 flex flex-col-reverse overflow-scroll">
        <ul>
            <li v-for="message in messages" v-bind:key="message.id">
                내용: {{ message.message }}
                글쓴이: {{ message.user.name }}
            </li>
        </ul>
      </div>
  </div>
</template>

<script>
import MessageItem from './MessageItem';
    export default {
        props: ['messages'],
        components: { MessageItem },
    }   
</script>

<style>

</style>