import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import AllPosts from './pages/AllPosts.vue';
import VipPosts from './pages/VipPosts.vue';
import Search from './pages/Search.vue';
import NewPost from './pages/NewPost.vue';
import SignIn from './pages/SignIn.vue';
import SignUp from './pages/SignUp.vue';
import PostPage from './pages/PostPage.vue';
import UserProfile from './pages/UserProfile.vue';
import AgencyProfile from './pages/AgencyProfile.vue';
import SavedPosts from './pages/SavedPosts.vue';
import SuccessfulScorePayment from './pages/Success/SuccessfulScorePayment.vue';
import SuccessfulVIPPayment from './pages/Success/SuccessfulVIPPayment.vue';
import FlagsPage from './pages/FlagsPage.vue';
import AgenciesPage from './pages/AgenciesPage.vue';
import UsersPage from './pages/UsersPage.vue';
import AddAgencyPage from './pages/AddAgencyPage.vue';

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
        path: '/vip-elanlar',
        name: 'vipPosts',
        component: VipPosts
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
    },
    {
        path: '/post/:id/successful-score-payment/:radioScore',
        name: 'succesfulScorePayment',
        component: SuccessfulScorePayment,
        props: true,
        // beforeEnter: (to, from, next) => {
        //     console.log("TO")
        //     console.log(to)
        //     console.log("FROM")
        //     console.log(from)
        //     console.log("NEXT")
        //     console.log(next)
        // }
    },
    {
        path: '/post/:id/make-vip',
        name: 'vipPayment',
        component: SuccessfulVIPPayment,
        props: true
    },
    {
        path: '/user/:id',
        name: 'userProfile',
        component: UserProfile,
        props: true,
    },
    {
        path: '/agency/:id',
        name: 'agencyProfile',
        component: AgencyProfile,
        props: true,
    },
    {
        path: '/flags',
        name: 'flags',
        component: FlagsPage
    },
    {
        path: '/agencies',
        name: 'agencies',
        component: AgenciesPage
    },
    {
        path: '/add-agency',
        name: 'add-agency',
        component: AddAgencyPage
    },
    {
        path: '/users',
        name: 'users',
        component: UsersPage
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