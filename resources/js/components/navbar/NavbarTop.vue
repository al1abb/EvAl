<template>
    <div
        class="d-flex justify-content-end align-items-center p-2"
        style="background-color: #FFFFFF;"
    >
        
        <ProfileMenu :auth="authenticated" :user="user" />

        <div v-if="!authenticated">
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
    computed: {
        ...mapState(["authenticated", "user"])
    }
};
</script>

<style>

</style>
