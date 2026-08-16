## Vue state handling/management

When prop-drilling (`props` down, `emit` up) and shared composables stop scaling, reach for a state store.

### First: do you actually need one?
* For most apps, a small **shared composable** built on `ref`/`computed` (or Vue's `provide` / `inject`)
  is enough, and that is the current default recommendation. Add a full store only for genuinely complex,
  widely-shared state.

### Pinia (the official Vue store)
* Install: `npm install pinia` (Pinia is the current default; the older **Vuex** is in maintenance mode).
* Register it in `main.ts`:
```ts
// main.ts
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';

createApp(App).use(createPinia()).mount('#app');
```
* Define a store with the setup syntax — **state** (refs), **getters** (computed) and **actions**
  (functions) all live in one place:
```ts
// stores/users.ts
import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

interface User { id: number; name: string; }

export const useUsersStore = defineStore('users', () => {
    const users = ref<User[]>([]);                    // state
    const count = computed(() => users.value.length); // getter

    async function load() {                            // action
        const res = await fetch('https://jsonplaceholder.typicode.com/users');
        users.value = await res.json();
    }

    return { users, count, load };
});
```
* Components call `const store = useUsersStore()`, then read `store.users` / `store.count` and call
  `store.load()`. Pinia is fully typed and works with the Vue DevTools out of the box.

> The same idea in other ecosystems: Angular has **NgRx**; React has **Redux Toolkit** or **Zustand**,
> with **TanStack Query** handling server state. Different names, same pattern.
