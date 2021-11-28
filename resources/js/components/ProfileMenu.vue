<template>
    <div v-if="auth && !loading" class="profileMenu">
        
        <span class="mx-2">{{ user.name }}</span>

        <v-menu
            transition="slide-y-transition"
            open-on-hover
            bottom
            offset-y
        >
            <template v-slot:activator="{ on, attrs }">
                <v-avatar
                    class="elevation-2"
                    color="" 
                    size="50"
                    v-bind="{attrs}"
                    v-on="on"
                >
                    <v-icon
                        color="gray"
                        size="50"
                    >
                        mdi-account-circle
                    </v-icon>

                </v-avatar>

            </template>

            <v-list>
                <v-list-item
                    link
                    @click="goToProfile"
                >
                    Profile
                </v-list-item>

                <v-list-item
                    link
                >
                    Settings
                </v-list-item>

                <v-list-item
                    @click="logout"
                >
                    Logout
                </v-list-item>
            </v-list>
        </v-menu>
        <!-- <router-link :to="'/user/'+user.id">
            
        </router-link> -->
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    props: ["auth", "user"],
    data() {
        return {
            loading: false,
        }
    },
    methods: {
        ...mapActions([
            "signOut"
        ]),

        goToProfile() {
            this.loading = true

            this.$router.push({
                path: '/user/' + this.user.id,
                params: this.user.id
            })

            this.loading = false
        },

        logout() {
            this.loading = true
            this.signOut()
            this.loading = false
        }
    },
}
</script>

<style>
.profileMenu:hover {
    cursor: pointer !important;
}
</style>