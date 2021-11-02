import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import SignIn from './pages/SignIn.vue';
import SignUp from './pages/SignUp.vue';
import PostPage from './pages/PostPage.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/daxil-ol',
        name: 'signin',
        component: SignIn,
    },
    {
        path: '/qeydiyyat',
        name: 'signup',
        component: SignUp
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