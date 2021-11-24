import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import AllPosts from './pages/AllPosts.vue';
import Search from './pages/Search.vue';
import NewPost from './pages/NewPost.vue';
import SignIn from './pages/SignIn.vue';
import SignUp from './pages/SignUp.vue';
import PostPage from './pages/PostPage.vue';
import SavedPosts from './pages/SavedPosts.vue';

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
        path: '/isarelenmisler',
        name: 'savedPosts',
        component: SavedPosts
    },
    {
        path: '/butun-elanlar',
        name: 'allPosts',
        component: AllPosts
    },
    {
        path: '/axtar',
        name: 'search',
        component: Search
    },
    {
        path: '/yeni-elan',
        name: 'newPost',
        component: NewPost
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
    scrollBehavior (to, from, savedPosition) {
        // console.log(to)
        // console.log(from)
        // console.log(savedPosition)
        if (savedPosition) {
            // console.log(savedPosition)
            return { x: 0, y: 0, behavior: 'smooth' }
        } else {
            return { x: 0, y: 0, behavior: 'smooth' }
        }
    }
});
export default router;