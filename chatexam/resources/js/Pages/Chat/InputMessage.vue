<template>
  <form @submit.prevent="submit">
    <input v-model="chat" type="text" placeholder="message"/>
    <button type="submit">Submit</button>
  </form>
</template>

<script>
    export default {
        data() {
            return {
                chat: "",
            }
        },
        methods: {

        },
    }
</script>

<style>

</style>