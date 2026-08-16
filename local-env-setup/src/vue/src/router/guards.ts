import type { NavigationGuard } from 'vue-router';

// Augment the route meta so `meta.requiresAuth` is type-checked.
declare module 'vue-router' {
  interface RouteMeta {
    requiresAuth?: boolean;
  }
}

/**
 * Global navigation guard (the Vue Router equivalent of Angular's canMatch guard).
 * Runs before every navigation: routes flagged `meta.requiresAuth` are only
 * reachable when the visitor is "logged in". Otherwise it returns a location
 * object, which the router treats as a redirect to the login page.
 */
export const accessGuard: NavigationGuard = (to) => {
  const loggedIn = localStorage.getItem('loggedIn') === 'true';

  if (to.meta.requiresAuth && !loggedIn) {
    return { name: 'login' };
  }
  return true;
};
