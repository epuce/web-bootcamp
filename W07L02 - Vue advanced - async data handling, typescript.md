# 🔷 Vue advanced - async data handling, typescript

## TypeScript

* Vue works great with TypeScript — add `lang="ts"` to `<script setup>` and type your refs, props and data.
* If an action is specific to a data type and the type is unknown, the compiler can't check the code and you lose autocomplete + safety.

```ts
// Define your own shapes with an interface (or a type)
interface User {
  name: string;
  age: number;
  childNames: string[];
}

import { ref } from 'vue';

const myText = ref<string>('');
const myNumber = ref<number>(0);
const myBool = ref<boolean>(false);
const anyData = ref<any>();          // "any" opts out of type checking, avoid it

const numberArray1 = ref<number[]>([]);
// OR
const numberArray2 = ref<Array<number>>([]);

const userEdmunds = ref<User>();     // typed with the interface above
```

```ts
let array: number[]; // If the variable has not been set, always add a data type

array = [1, 2, 3, 4];

array.map((num) => {
  return num.length; // Would error — TypeScript knows numbers have no length property

  return num ** 2;   // Valid return statement
});
```

## Server requests

Vue has no built-in HTTP client — use the browser's `fetch` (or a library like **axios**). Fire the
request in the `onMounted` lifecycle hook and store the result in a `ref` so the template updates
reactively.

```vue
<script setup lang="ts">
import { ref, onMounted } from 'vue';

interface User { id: number; name: string; email: string; }

const list = ref<User[]>([]);

onMounted(async () => {
  try {
    const res = await fetch('https://jsonplaceholder.typicode.com/users');
    list.value = await res.json();
  } catch {
    // show an error that the request was not successful
  }

  await calculateData();
});

// The power of async: run independent work concurrently with Promise.all
async function calculateData() {
  const delay = (ms: number) =>
    new Promise<number>((resolve) => setTimeout(() => resolve(Math.random() * 100), ms));

  // ~6s total, not 1+3+6=10s, because they run at the same time
  const [a, b, c] = await Promise.all([delay(1000), delay(3000), delay(6000)]);
  console.log(a + b + c);
}
</script>
```

> [!TIP]
> **Checkup**
>
> 1. Create a component
> 2. Make a request to a public API that has image links in it
> 3. Print the images to the newly created component
