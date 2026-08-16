<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';

/**
 * Minimal login page. On submit it flips a flag in localStorage and
 * navigates to the protected index page. The `accessGuard` reads the same
 * flag to decide whether the index route may be entered.
 */
const router = useRouter();
const username = ref('demo');

function onSubmit(): void {
  localStorage.setItem('loggedIn', 'true');
  router.push({ name: 'index' });
}
</script>

<template>
  <section class="login">
    <h1>Login</h1>
    <p>Any credentials work in this demo — submitting just marks you as logged in.</p>

    <form class="login__form" @submit.prevent="onSubmit">
      <label class="login__field">
        <span>Username</span>
        <input name="username" type="text" v-model="username" />
      </label>
      <button type="submit">Sign in</button>
    </form>
  </section>
</template>

<style scoped>
.login { max-width: 22rem; }
.login__form { display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1rem; }
.login__field { display: flex; flex-direction: column; gap: 0.25rem; }
button { padding: 0.5rem 1rem; cursor: pointer; }
</style>
