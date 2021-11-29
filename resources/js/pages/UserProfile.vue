<template>
    <div class="container-sm">
        
        <div v-if="!userNotFound">
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
                        v-if="localUser.avatar == null && !loading"
                    >
                        mdi-account-circle
                    </v-icon>

                    <v-img
                        :src="`/storage/${localUser.avatar}`" 
                        :size="avatarSize"
                        color="#919191"
                        v-if="localUser.avatar && !loading"
                    >
                    </v-img>

                    <v-skeleton-loader
                        v-if="loading"
                        type="avatar"
                    >
                    </v-skeleton-loader>

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
            <div class="my-2" v-if="!loading && localUser.name">
                Son görünmə: {{ lastSeen }}
            </div>

        </div>

        <div v-if="userNotFound && !loading">
            <div class="p-3 text-center" style="background-color: #E5E5E5; color: #595959; border-radius: 10px;">
                <p style="font-size: 1.2rem;">Belə bir istifadəçi tapılmadı</p>
            </div>
        </div>
        
    </div>
</template>

<script>
// import moment from 'moment';
// import moment from 'moment/min/moment-with-locales'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
import 'dayjs/locale/az'
import { mapState } from 'vuex'
export default {
    data() {
        return {
            loading: true,
            localUser: {},
            // authorized: false,

            avatarSize: '11rem',
            online: false,

            userNotFound: false,
        }
    },
    methods: {
        async getUser(id) {
            this.loading = true

            const res = await this.fetchUser(id)

            // if response is empty then stop
            if(res=='') {
                return 0;
            }

            this.localUser = res
            this.checkOnlineStatus(2)
            this.loading = false
        },
        
        async fetchUser(id) {
            const res = await axios.get(`/api/user/${id}`).catch((err) => {
                console.log(err)
                this.userNotFound = true
                this.loading = false
            })

            // * If shown user is not auth()->user then do not show phone number
            // if(this.authorized == false) {
            //     res.data.phone_number=null
            // }

            return res ? res.data : ''
        },

        checkOnlineStatus(timeInMinutes) {
            const userLastSeen = Date.parse(this.localUser.last_seen)
            console.log(userLastSeen, Date.now())
            if(userLastSeen > (Date.now() - timeInMinutes*60*1000)) {
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

        authorized() {
            if(this.authenticated && this.localUser.id==this.user.id) {
                return true;
            }
            else {
                return false
            }
        },

        lastSeen() {
            const lastSeenTime = dayjs(this.localUser.last_seen).locale('az').fromNow()
            return lastSeenTime
        }
    },
    mounted() {
        this.getUser(this.$route.params.id)
        console.log(this.authorized)
    },
    created() {
        dayjs.extend(relativeTime);
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