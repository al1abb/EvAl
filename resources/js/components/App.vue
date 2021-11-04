<template>

    <v-app
        class="appMain"
    >
        <Navbar />

        <!-- <v-container>

            <v-row class="text-center">
                <v-col>
                    <p><router-link to="/">Home</router-link></p>
                </v-col>

                <v-col>
                    <p><router-link to="/test">Test</router-link></p>
                </v-col>
            </v-row>

        </v-container> -->

        <router-view v-slot="{ Component }">
            <component :is="Component" />
        </router-view>

    </v-app>

</template>

<script>
import Navbar from './navbar/Navbar.vue';

import { mapState } from "vuex";

export default {
    components: { Navbar },
    computed: {
        ...mapState(["authenticated, user"]),
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie');
    },
    beforeCreate() {
        this.$store.commit('initialiseStore')
    }
}
</script>

<style>
/**
    Resets
*/

.reset_word_spacing {
    letter-spacing: 0px !important;
}

.no-uppercase {
    text-transform: none;
}

a, a:hover, a:focus, a:active {
    text-decoration: none !important;
    color: inherit !important;
}

p {
    margin: 0px !important;
    padding: 0px !important;
}



.appMain {
    background-color: #f7f2f2 !important;    
}

.brandName {
    color: white;

    font-size: 1.5rem;
}
</style>