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

import axios from "axios";

const store = new Vuex.Store({
    state: {
        authenticated: false,
        user: {},
        loading: false,
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
        initialiseStore(state) {
            state.loading = true;
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

Vue.use(VueRouter).use(store);

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