<template>
    <div>
        <h1>Hello Nuxt</h1>
        <p>{{ message }}</p>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from '@vue/composition-api'

export default defineComponent({
  setup () {
    const message = ref('This is a message')
    return {
      message
    }
  }
})
</script>

<style>

</style>