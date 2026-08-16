# Vue

This project was generated with [Vue](https://vuejs.org/) + [Vite](https://vite.dev/) and TypeScript.

## Development server

Run `npm install` once, then `npm run dev` for a dev server. Navigate to the URL Vite prints (default `http://localhost:5173/`). The application reloads automatically when you change any source file.

## Build

Run `npm run build` to type-check and build the project. The build artifacts are stored in the `dist/` directory. Preview a production build with `npm run preview`.

## Project structure

* `src/main.ts` — app entry point (creates the app, registers the router)
* `src/App.vue` — root component (header + `<RouterView />`)
* `src/router/` — route definitions and the `accessGuard` navigation guard
* `src/components/` — reusable components (e.g. the header)
* `src/views/` — routed pages (index, login)

## Further help

See the [Vue docs](https://vuejs.org/guide/) and the [Vue Router docs](https://router.vuejs.org/).
