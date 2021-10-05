<template>
  <ul>
      <li v-for="message in messages" v-bind:key="message.id">
          내용: {{ message.message }}
          글쓴이: {{ message.user.name }}
      </li>
  </ul>
</template>

<script>
    export default {
        props: ['messages'],
    }
</script>

<style>

</style>