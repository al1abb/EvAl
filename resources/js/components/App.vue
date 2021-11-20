<template>
    <v-app
        class="appMain"
    >
        <Navbar />

        <router-view v-slot="{ Component }">
            <component :is="Component" />
        </router-view>

        <Footer />

    </v-app>
</template>

<script>
import { mapState } from "vuex";

import Navbar from './navbar/Navbar.vue';
import Footer from './Footer.vue';

export default {
    components: { Navbar, Footer },
    computed: {
        ...mapState(["authenticated, user"]),
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