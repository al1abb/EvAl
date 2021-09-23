import { createRouter, createWebHistory } from 'vue-router';
import Home from './pages/Home.vue';
import RouterTest from './pages/RouterTest.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/test',
        name: 'test',
        component: RouterTest,
    }
];

const routerHistory = createWebHistory()

const router = createRouter({
    history: routerHistory,
    routes: routes,
});

export default router;