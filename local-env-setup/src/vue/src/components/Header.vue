<script setup lang="ts">
// RouterLink renders an <a> that navigates without a full page reload.
// The `router-link-active` / `router-link-exact-active` classes are added
// automatically to the link matching the current URL.
</script>

<template>
  <header class="app-header">
    <span class="app-header__brand">Vue 3 demo</span>
    <nav class="app-header__nav">
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/login">Login</RouterLink>
    </nav>
  </header>
</template>

<style scoped>
.app-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1.25rem;
  background: #42b883;
  color: #fff;
}
.app-header__brand {
  font-weight: 700;
}
.app-header__nav {
  display: flex;
  gap: 1rem;
}
.app-header__nav a {
  color: #fff;
  text-decoration: none;
}
.app-header__nav a.router-link-active {
  text-decoration: underline;
}
</style>
