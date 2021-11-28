<template>
    <div class="container-sm">
        
        <div v-if="!loading">
            <!-- this is user profile page {{ $route.params.id }}
            User: <pre>{{ localUser }}</pre>
            <p>{{ authorized }}</p> -->

            <div class="avatarCont">

                <v-avatar
                    :size="avatarSize"
                    style="position: relative; background-color: transparent;"
                >
                    <v-icon
                        :size="avatarSize"
                        color="#919191"
                        v-if="localUser.avatar == null"
                    >
                        mdi-account-circle
                    </v-icon>

                    <v-img
                        :src="`/storage/${localUser.avatar}`" 
                        :size="avatarSize"
                        color="#919191"
                        v-if="localUser.avatar"
                    >

                    </v-img>

                    <div v-if="online" :title="online ? 'Onlayn' : 'Offline'" class="d-flex justify-content-center align-items-center onlineCircleWrapper">
                        <div class="onlineCircle">
                        </div>
                    </div>
                </v-avatar>
                
                
            </div>

            <p class="userProfile__name">{{ localUser.name }}</p>
            <p class="userProfile__email text-muted">{{ localUser.email }}</p>

            <div class="my-2" v-if="authorized">
                <v-btn
                    outlined
                    color="primary"
                    class="no-uppercase text-center"
                >
                    <v-icon>
                        mdi-pencil
                    </v-icon>
                    Edit account
                </v-btn>
            </div>

            <!-- //TODO: TURN time into human readable time -->
            <div class="my-2">
                Last seen: {{ lastSeen }}
            </div>

        </div>
        
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    data() {
        return {
            loading: true,
            localUser: {},
            authorized: false,

            avatarSize: '15rem',
            online: false,
        }
    },
    methods: {
        // getUser() {
        //     this.localUser = this.user
        // }
        async getUser(id) {
            this.loading = true
            this.authorized = this.authenticated

            const res = await this.fetchUser(id)
            this.localUser = res
            this.checkOnlineStatus()
            this.loading = false
        },
        
        async fetchUser(id) {
            const res = await axios.get(`/api/user/${id}`)

            // * If shown user is not auth()->user then do not show phone number
            // if(this.authorized == false) {
            //     res.data.phone_number=null
            // }

            return res.data
        },

        checkOnlineStatus() {
            const userLastSeen = Date.parse(this.localUser.last_seen)
            console.log(userLastSeen, Date.now())
            if(userLastSeen > (Date.now() - 2*60*1000)) {
                console.log("Online")
                this.online = true
            }
            else {
                console.log("not online")
                this.online = false
            }
        }
    },
    computed: {
        ...mapState(["authenticated", "user"]),

        lastSeen() {
            const lastSeenTime = this.localUser.last_seen
            return lastSeenTime
        }
    },
    mounted() {
        this.getUser(this.$route.params.id)
    }
}
</script>

<style scoped>
.onlineCircleWrapper {
    width: 2.5rem;
    height: 2.5rem;

    border-radius: 30px;

    position: absolute;
    bottom: 13%;
    right: 13%;

    background-color: #F2F2F2;
}

.onlineCircle {
    padding: 10px;

    border-radius: 30px;

    width: 2rem;
    height: 2rem;

    background-color: #AAD312;
}

.userProfile__name {
    font-size: 1.8rem;
    font-weight: bold;
}

.userProfile__email {
    /* color: gray; */

    font-size: 1.2rem;
    font-weight: 300;
}
</style>