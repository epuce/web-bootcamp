<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

/**
 * Protected landing page (reachable only through the `accessGuard`).
 * Demonstrates three modern Vue features:
 *  - `ref()` reactive state for the counter,
 *  - `fetch` in the `onMounted` lifecycle hook to load data,
 *  - the built-in `v-if` / `v-for` control-flow directives in the template.
 */
interface User {
  id: number;
  name: string;
  email: string;
}

const router = useRouter();

// ref() holds reactive state; read/write it through .value in <script>.
const count = ref(0);
const users = ref<User[]>([]);
const loading = ref(true);
const error = ref<string | null>(null);

function increment(): void {
  count.value++;
}

function decrement(): void {
  count.value--;
}

onMounted(async () => {
  try {
    // JSONPlaceholder is a free, key-less public API.
    const res = await fetch('https://jsonplaceholder.typicode.com/users');
    if (!res.ok) throw new Error('Request failed');
    users.value = await res.json();
  } catch {
    error.value = 'Could not load users. Please try again later.';
  } finally {
    loading.value = false;
  }
});

function logout(): void {
  localStorage.removeItem('loggedIn');
  router.push({ name: 'login' });
}
</script>

<template>
  <section class="index">
    <h1>Welcome</h1>
    <p>You are logged in. This page is protected by the <code>accessGuard</code>.</p>

    <div class="index__counter">
      <button type="button" @click="decrement">-</button>
      <strong>{{ count }}</strong>
      <button type="button" @click="increment">+</button>
      <span>(ref-based counter)</span>
    </div>

    <h2>Users</h2>

    <p v-if="loading">Loading users…</p>
    <p v-else-if="error" class="index__error">{{ error }}</p>
    <ul v-else class="index__list">
      <li v-for="user in users" :key="user.id">
        <strong>{{ user.name }}</strong> — {{ user.email }}
      </li>
      <li v-if="!users.length">No users found.</li>
    </ul>

    <button type="button" class="index__logout" @click="logout">Log out</button>
  </section>
</template>

<style scoped>
.index { max-width: 40rem; }
.index__counter { display: flex; align-items: center; gap: 0.75rem; margin: 1rem 0; }
.index__counter button { width: 2rem; cursor: pointer; }
.index__list { line-height: 1.8; }
.index__error { color: #c62828; }
.index__logout { margin-top: 1.5rem; padding: 0.5rem 1rem; cursor: pointer; }
</style>
