### Vue project setup
* `npm create vue@latest` (scaffolds a **Vite**-based project; the wizard asks whether you want TypeScript, Vue Router, Pinia, etc.)
* pick a project name (I would use "web", as we will integrate it into the main project)
* `cd` into the project, then run `npm install`
* All npm scripts are listed under the project's README.md / package.json
* Run the dev server (`npm run dev`) so files are compiled and hot-reloaded when changed
### Component setup
```vue
<!-- ExampleComponent.vue — a Single File Component (SFC) -->
<script setup lang="ts">
import { ref } from 'vue';

// State lives in refs: read/write with heading.value in <script>,
// and just `heading` in the template (Vue unwraps it automatically).
const heading = ref('My Heading');
</script>

<template>
  <h1>{{ heading }}</h1>
</template>

<style scoped>
/* styles here are scoped to this component only */
</style>
```
* A `.vue` Single File Component keeps template, logic and styles in one file. `<script setup>` is the
  modern, compile-time API; the old Options API (`export default { data() { ... } }`) still works but is
  not how new code is written.

### Data binding & template control flow
```vue
<script setup lang="ts">
import { ref } from 'vue';

const loggedIn = ref(true);
const heading = ref('My Heading');
const items = ref([
  { id: 1, name: 'First', active: true },
  { id: 2, name: 'Second', active: false },
]);
</script>

<template>
  <!-- v-if / v-for are Vue's built-in control flow, used right in the markup -->
  <h1 v-if="loggedIn">{{ heading }}</h1>

  <ul>
    <li v-for="item in items" :key="item.id" :class="{ active: item.active }">
      {{ item.name }}
    </li>
  </ul>
</template>
```
* `{{ }}` interpolates text, `:prop` (shorthand for `v-bind:prop`) binds attributes/props, and
  `@event` (shorthand for `v-on:event`) listens to events.
* Always give `v-for` a unique `:key` so Vue can track and reuse DOM nodes efficiently.
