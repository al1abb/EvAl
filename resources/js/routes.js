import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import RouterTest from './pages/RouterTest.vue';
import PostPage from './pages/PostPage.vue';

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
    },
    {
        path: '/post/:id',
        name: 'postPage',
        component: PostPage,
        props: true
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
});
export default router;