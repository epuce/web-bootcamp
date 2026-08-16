# 🎛️ Vue material & form handling

## Vuetify (Material Design for Vue)

* [documentation](https://vuetifyjs.com/en/components/all/)
* Add the npm packages

```json
"dependencies": {
    "vuetify": "^3.7.0",
    "@mdi/font": "^7.4.0"
}
```

* Register Vuetify once as a plugin (Vuetify is set up globally in `main.ts`, not imported per component):

```ts
// main.ts
import { createApp } from 'vue';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css';
import App from './App.vue';

const vuetify = createVuetify({ components, directives });

createApp(App).use(vuetify).mount('#app');
```

* Set up the Vuetify component template & script if needed

```vue
<!-- For a table -->
<template>
  <v-data-table
    :headers="headers"
    :items="list"
  />
</template>
```

```ts
// For the table
import { ref } from 'vue';

const headers = [
    { title: '#', key: 'id' },
    { title: 'Name', key: 'name' },
];
const list = ref([]);
```

```vue
<!-- For inputs -->
<template>
  <v-text-field
    label="Name"
    v-model="form.name"
  />

  <v-checkbox
    label="Active"
    v-model="form.active"
  />
</template>
```

```ts
// For inputs
import { reactive } from 'vue';

const form = reactive({
    name: '',
    active: false,
});
```

> [!TIP]
> **Checkup**
>
> * Set up a state manager for list handling from - https://jsonplaceholder.typicode.com/posts?_page=1&_limit=10 where the page number is set by you
> * Show requested data in a Vuetify data table
> * Set up a Vuetify input field where the user enters a number
> * Add a button that requests the data with page number that is set in the input field
> * Show a loading symbol while the request is pending
> * Update the table
