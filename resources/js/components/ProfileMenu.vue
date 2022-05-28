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
                    <v-img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7JvxfS8YsVlqnRbNFNx3b7t5UUsl4p_8V2A&usqp=CAU"
                        color="#919191"
                        v-if="!loading"
                    >
                        <template v-slot:placeholder>
                            <v-sheet>
                                <v-skeleton-loader
                                    type="image"
                                >
                                </v-skeleton-loader>
                            </v-sheet>
                        </template>
                    </v-img>
                    <!-- <v-img
                        :src="`/storage/${user.avatar}`" 
                        v-if="user.avatar != null && !loading"
                    >
                    </v-img> -->

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
                    v-if="userIsAdmin"
                    link
                    @click="goToFlags"
                >
                    Flags
                </v-list-item>

                <v-list-item
                    v-if="userIsMod"
                    link
                    @click="goToAddAgency"
                >
                    Add agency
                </v-list-item>

                <v-list-item
                    v-if="userIsAdmin"
                    link
                    @click="goToAgencies"
                >
                    Agencies
                </v-list-item>

                <v-list-item
                    v-if="userIsAdmin"
                    link
                    @click="goToUsersPage"
                >
                    Users
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

        goToFlags() {
            this.loading = true

            this.$router.push({
                path: '/flags',
            })

            this.loading = false
        },

        goToAddAgency() {
            this.loading = true

            this.$router.push({
                path: '/add-agency',
            })

            this.loading = false
        },

        goToAgencies() {
            this.loading = true

            this.$router.push({
                path: '/agencies',
            })

            this.loading = false
        },

        goToUsersPage() {
            this.loading = true

            this.$router.push({
                path: '/users',
            })

            this.loading = false
        },

        logout() {
            this.loading = true
            this.signOut()
            this.loading = false
        }
    },
    computed: {
        userIsAdmin() {
            return this.user.role == 'administrator'
        },
        userIsMod() {
            return this.user.role == 'moderator'
        }
    },
    // mounted() {
    //     console.log("USER ROLE CHECK in profilemenu.vue")
    //     this.user.role == 'admin' ? console.log("admin user") : console.log("user is not admin")
    // }
}
</script>

<style>
.profileMenu:hover {
    cursor: pointer !important;
}
</style>