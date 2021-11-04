<template>
    <div
        class="d-flex justify-content-end align-items-center p-2"
        style="background-color: #FFFFFF;"
    >
        <v-scroll-x-reverse-transition
            hide-on-leave
        >
            <div v-if="loading">
                <v-skeleton-loader
                    type="avatar"
                >
                </v-skeleton-loader>
            </div>

            <ProfileMenu v-if="!loading && authenticated" :auth="authenticated" :user="user" />
        </v-scroll-x-reverse-transition>

        <div v-if="!loading && !authenticated">
            <router-link
                to="/daxil-ol"
                class="no-uppercase reset_word_spacing text-success p-2"
            >
                Daxil ol
            </router-link>

            <router-link
                to="/qeydiyyat"
                class="no-uppercase reset_word_spacing text-danger p-2"
            >
                Qeydiyyat
            </router-link>
        </div>
        
    </div>
</template>

<script>
import { mapState } from 'vuex';
import ProfileMenu from '../ProfileMenu.vue';
export default {
    components: { ProfileMenu },
    data() {
        return {
            
        }
    },
    computed: {
        ...mapState(["authenticated", "user", "loading"])
    }
};
</script>

<style>

</style>
