<script setup>
import { ref } from 'vue'

const text = ref('This is how Vue binds data to HTML')
const count = ref(0)

function addOne() {
  count.value++
}
</script>

<template>
  <main class="app">
    <h1>{{ text }}</h1>
    <h2>You have clicked {{ count }} times</h2>
    <button type="button" @click="addOne">Add one</button>
  </main>
</template>

<style scoped>
.app {
  font-family: system-ui, sans-serif;
  max-width: 40rem;
  margin: 2rem auto;
  text-align: center;
}

button {
  padding: 0.5rem 1rem;
  font-size: 1rem;
  cursor: pointer;
}
</style>
