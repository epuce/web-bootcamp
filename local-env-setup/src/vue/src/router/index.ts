import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';
import { accessGuard } from './guards';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'index',
      // Lazy-load the protected view with a dynamic import
      // (only fetched when the route is first visited).
      component: () => import('../views/IndexView.vue'),
      meta: { requiresAuth: true },
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    // Anything else falls back to the (guarded) index.
    { path: '/:pathMatch(.*)*', redirect: '/' },
  ],
});

// Runs before every navigation.
router.beforeEach(accessGuard);

export default router;
