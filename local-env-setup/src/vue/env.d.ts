/// <reference types="vite/client" />

// Lets TypeScript understand `import X from './X.vue'`.
declare module '*.vue' {
  import type { DefineComponent } from 'vue';
  const component: DefineComponent<{}, {}, any>;
  export default component;
}
