# 🧭 Vue routing and form handling

## Vue routing

* Vue is a single page application (SPA) system: what does that mean?
    * After the initial page load, only the extra data needed for the new page is loaded. So the static page elements, styles, scripts and others are not loaded again.
    * Routing is provided by the official **Vue Router** package (`npm install vue-router`, or enable it in the `npm create vue` wizard).
    * [documentation](https://router.vuejs.org/)

```ts
// router/index.ts
import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';
import { accessGuard } from './guards';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/login', name: 'login', component: LoginView },
    {
      path: '/',
      name: 'index',
      // Lazy-load a view with a dynamic import (only fetched when first visited)
      component: () => import('../views/IndexView.vue'),
      meta: { requiresAuth: true },
    },
    { path: '/:pathMatch(.*)*', redirect: '/login' }, // catch-all
  ],
});

// Register the guard (see below)
router.beforeEach(accessGuard);

export default router;

// Wired up in main.ts:
//   createApp(App).use(router).mount('#app');
```

```ts
// router/guards.ts
import type { NavigationGuard } from 'vue-router';

// A global navigation guard: it runs before every route change. If the target
// route needs auth and the visitor isn't logged in, redirect to /login.
export const accessGuard: NavigationGuard = (to) => {
    if (to.meta.requiresAuth && localStorage.getItem('loggedIn') !== 'true') {
        return { name: 'login' }; // returning a location performs the redirect
    }
    return true; // allow navigation
};
```

> [!TIP]
> **Checkup**
>
> * Set up a static component (like header, or footer) that will be shown on all pages
> * Add two pages that display different components
> * Allow to access one of the pages by a condition (like, if there has been a click on a button in the first page)
> * Display some server data on the page with access restrictions

## Vue form handling

* `v-model` creates a two-way binding between a form input and reactive state — no manual event wiring needed.

```vue
<script setup lang="ts">
import { reactive } from 'vue';

// reactive() groups related form fields into one reactive object
const form = reactive({
    name: '',
    active: false,
});

function onSubmit() {
    console.log('The current values are', form);
}
</script>

<template>
  <form @submit.prevent="onSubmit">
    <input placeholder="Name" v-model="form.name" />

    <label>
      <input type="checkbox" v-model="form.active" />
      Active
    </label>

    <button type="submit">Save</button>
  </form>
</template>
```

* For validation you can watch the values and toggle classes, or reach for a library like
  **VeeValidate** or **Vuelidate** on bigger forms.

> [!TIP]
> **Checkup**
>
> 1. Create two different pages (components)
> 2. Add a form to one of them with the possibility for a user to login
>     * Create form validation (can add some classes based on that)
>     * If the login has been successful (can imitate this) save some flag to localStorage and redirect to the other page
> 3. Allow to access the second page only if the login has been successful
>     * redirect back to login if not
