/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from "vue-router";
import Vuex from "vuex";
import router from "./routes";
import vuetify from './vuetify';

import * as VueGoogleMaps from 'vue2-google-maps';

// import VueAwesomeSwiper from 'vue-awesome-swiper';
// import 'swiper/css/swiper.css';

import axios from "axios";

const store = new Vuex.Store({
    state: {
        authenticated: false,
        user: {},
        loading: false,
        searchLoading: false,
        searchQueryStore: {},
        searchData: {},
        savedPosts: [],
    },

    getters: {
        authenticated(state) {
            return state.authenticated;
        },
        user(state) {
            return state.user;
        },
        loading(state) {
            return state.loading;
        },
        searchLoading(state) {
            return state.searchLoading;
        },
        searchQueryStore(state) {
            return state.searchQueryStore;
        },
        searchData(state) {
            return state.searchData;
        },
        savedPosts(state) {
            return state.savedPosts;
        }
    },

    mutations: {
        setAuthenticated(state, payload) {
            state.authenticated = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setLoading(state, payload) {
            state.loading = payload;
        },
        setSearchLoading(state, payload) {
            state.searchLoading = payload;
        },
        setSearchQueryStore(state, payload) {
            state.searchQueryStore = payload;
        },
        setSearchData(state, payload) {
            state.searchData = payload;
        },
        setSavedPosts(state, payload) {
            state.savedPosts = payload
        },
        initialiseStore(state) {
            state.loading = true;

            // Check saved posts from localstorage
            let savedPostsInit = JSON.parse(localStorage.getItem('savedPostsLocalStorage'));
            if(savedPostsInit) {
                state.savedPosts = savedPostsInit;
            }

            // Check authentication status from localstorage
            if(localStorage.getItem('sanctum_token')) {
                let token = localStorage.getItem('sanctum_token');
                if(token) {
                    console.log(token)
                    axios.get('/api/user', {
                        headers: {
                            'Authorization': 'Bearer '+token
                        }
                    })
                    .then((response) => {
                        state.user = response.data;
                        state.authenticated = true;
                        state.loading = false;
                    })
                    .catch((err) => {
                        // ? This line of code below might be where to catch refresh token call

                        localStorage.removeItem('sanctum_token')
                        state.user = null
                        state.authenticated = false;
                        state.loading = false;
                    })
                }
            }
            else {
                localStorage.removeItem('sanctum_token')
                state.user = null
                state.authenticated = false;
                state.loading = false;
            }
        }
    },

    actions: {
        async signIn({ dispatch }, credentials) {
            await axios.get('/sanctum/csrf-cookie');
            const res = await axios.post('/api/login', credentials);
            localStorage.setItem('sanctum_token', res.data.token);

            return dispatch('me');
        },

        async signOut ({ dispatch }) {
            let token = localStorage.getItem('sanctum_token');
            
            await axios.post('/api/logout', {}, {
                headers: {
                    'Authorization': 'Bearer '+ token
                }
            });

            localStorage.removeItem('sanctum_token');

            return dispatch('me')
        },

        async register({ dispatch }, credentials) {
            await axios.get('/sanctum/csrf-cookie');
            const res = await axios.post('/api/register', credentials);
            localStorage.setItem('sanctum_token', res.data.token);

            return dispatch('me');
        },

        // TODO: Change POST request to GET request
        async search({ commit }, credentials) {
            commit('setSearchLoading', true);
            const res = await axios.post('/api/search', credentials);
            commit('setSearchData', res);
            commit('setSearchLoading', false);

            return res;
        },

        async savePost({ commit }, postId) {
            // if(this.state.savedPosts.includes(postId)) {
            //     console.log("Post already saved");
            // }
            // else {
                
            // }
            commit('setSavedPosts', [...this.state.savedPosts, postId]);
            // console.log(this.state.savedPosts);
            localStorage.setItem('savedPostsLocalStorage', JSON.stringify(this.state.savedPosts));
            console.log(postId);
        },

        async unsavePost({ commit }, postId) {
            // commit('setSavedPosts', state.savedPosts.filter((post) => {
            //     post == postId
            // }));

            const unsaved = this.state.savedPosts.filter((post) => post != postId)

            commit('setSavedPosts', unsaved);
            localStorage.setItem('savedPostsLocalStorage', JSON.stringify(this.state.savedPosts));
            console.log(postId);
        },

        me ({ commit }) {

            let token = localStorage.getItem('sanctum_token');
            console.log(token);
            if(token) {
                return axios.get('/api/user', {
                    headers: {
                        'Authorization': 'Bearer '+token
                    }
                })
                .then((response) => {
                    // console.log(response)
                    commit('setAuthenticated', true)
                    commit('setUser', response.data)
                })
            }
            else {
                commit('setAuthenticated', false)
                commit('setUser', null);
            }
        }
    }
})

Vue.use(VueRouter).use(store).use(VueGoogleMaps, {
    load: {
        key: process.env.MIX_GOOGLE_MAPS_API,
        region: 'AZ',
        language: 'az'
    },
    installComponents: true
});

// Gmap cluster
import GmapCluster from 'vue2-google-maps/dist/components/cluster' // replace src with dist if you have Babel issues
Vue.component('GmapCluster', GmapCluster)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import App from './components/App.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router,
    store,
    vuetify
});

export default app;