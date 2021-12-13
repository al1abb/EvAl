<template>
    <div class="container-sm">
        {{ avatar.name }}
        <div class="d-flex flex-column" v-if="!userNotFound">

            <div>
                <div class="avatarCont" style="position: relative; background-color: transparent; width: min-content;">

                    <v-hover
                        v-slot="{ hover }"
                    >
                        <v-avatar
                            :size="avatarSize"
                            style="position: relative;"
                        >
                            <div 
                                v-if="hover && !loading && authorized"
                                class="d-flex justify-content-center align-items-center"
                                style="position: absolute; z-index: 100; width: 100%; height: 100%; border-radius: 100%;"
                                :style="hover ? 'cursor: pointer;' : ''"
                                @click="$refs.file.click()"
                            >
                                <div class="text-light" style="font-size: 1rem;">
                                    <p>
                                        Update Avatar
                                    </p>

                                    <form method="PUT" enctype="multipart/form-data" @submit.prevent="submitAvatarForm" ref="avatarForm">
                                        <input @change="fileInputOnChange" type="file" name="avatar" accept="image/png, image/jpeg" ref="file" style="display: none">
                                        <button type="submit" ref="submitAvatarBtn" style="display: none;"></button>
                                    </form>
                                </div>
                            </div>

                            <v-img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7JvxfS8YsVlqnRbNFNx3b7t5UUsl4p_8V2A&usqp=CAU"
                                :size="avatarSize"
                                color="#919191"
                                v-if="localUser.avatar == null && !loading"
                                :style="authorized && hover ? 'filter: brightness(50%);' : ''"
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

                            <v-img
                                :src="`/storage/${localUser.avatar}`" 
                                :size="avatarSize"
                                color="#919191"
                                v-if="localUser.avatar || loading"
                                :style="authorized && hover ? 'filter: brightness(50%);' : ''"
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

                            <!-- <v-skeleton-loader
                                v-if="loading"
                                type="avatar"
                            >
                            </v-skeleton-loader> -->

                            
                        </v-avatar>
                    </v-hover>

                    <div v-if="online && !loading" :title="online ? 'Onlayn' : 'Offline'" class="d-flex justify-content-center align-items-center onlineCircleWrapper">
                        <div class="onlineCircle">
                        </div>
                    </div>
                    
                    
                </div>

                <div>
                    <div class="mt-5">
                        <v-skeleton-loader
                            type="paragraph"
                            max-width="25rem"
                            v-if="loading"
                        >
                        </v-skeleton-loader>
                    </div>

                    <div v-if="!loading" class="mt-5">
                        <p class="userProfile__name d-flex align-items-center">
                            {{ localUser.name }}
                            <v-icon
                                v-if="localUser.email_is_verified"
                                color="#1C99FC"
                                class="ml-2"
                                title="Verified account"
                            >
                                mdi-check-decagram
                            </v-icon>
                        </p>
                        <p class="userProfile__email text-muted">{{ localUser.email }}</p>

                        <div class="my-3">
                            <v-chip
                                :color="localUser.role=='administrator' ? '#fc6d6d' : (localUser.role=='moderator' ? 'orange' : 'green')"
                                outlined
                            >
                                <span style="font-size: 0.9rem;">{{ userRole }}</span>
                            </v-chip>
                        </div>

                        <div class="my-2" v-if="authorized">
                            <v-btn
                                outlined
                                color="primary"
                                class="no-uppercase text-center"
                                @click="openEditProfile"
                                v-if="editProfileBtnVisible"
                            >
                                <v-icon>
                                    mdi-pencil
                                </v-icon>
                                Edit account
                            </v-btn>

                            <div class="my-5" v-if="editProfileFormVisible" style="max-width: 20rem">
                                <v-form @submit.prevent="submitEditForm">
                                    <v-text-field
                                        v-model="editForm.name"
                                        label="Ad"
                                        prepend-icon="mdi-account"
                                        flat
                                        solo
                                        :loading="loading"
                                    >
                                    </v-text-field>

                                    <v-text-field
                                        v-model="editForm.email"
                                        label="E-mail"
                                        prepend-icon="mdi-email"
                                        flat
                                        solo
                                        :loading="loading"
                                    >
                                    </v-text-field>

                                    <v-text-field
                                        v-model="editForm.phone_number"
                                        label="Tel"
                                        prepend-icon="mdi-phone"
                                        flat
                                        solo
                                        :loading="loading"
                                    >
                                    </v-text-field>

                                    <v-text-field
                                        v-model="editForm.password"
                                        :type="confirmPasswordVisible ? 'text' : 'password'"
                                        label="Yeni şifrə"
                                        prepend-icon="mdi-lock"
                                        flat
                                        solo
                                        :loading="loading"
                                    >
                                        <template v-slot:append>
                                            <v-icon @click="confirmPasswordVisible=!confirmPasswordVisible">{{ confirmPasswordVisible ? 'mdi-eye-off' : 'mdi-eye' }}</v-icon>
                                        </template>
                                    </v-text-field>

                                    <v-btn
                                        class="no-uppercase"
                                        outlined
                                        color="green"
                                        type="submit"
                                    >
                                        Saxla
                                    </v-btn>

                                    <v-btn
                                        class="no-uppercase text-light"
                                        depressed
                                        color="red lighten-1"
                                        @click="closeEditForm"
                                    >
                                        Geri
                                    </v-btn>
                                </v-form>

                            </div>
                        </div>

                        <div v-if="localUser.agency!=null">
                            <p>İstifadəçi agentlik əməkdaşıdır</p>

                            <p class="userProfile__agencyName">
                                <router-link
                                    :to="`/agency/${localUser.agency_id}`"
                                >
                                    {{ localUser.agency.agency_name }}
                                </router-link>
                            </p>
                        </div>

                        <!-- //TODO: TURN time into human readable time -->
                        <div class="my-2" v-if="!loading && localUser.name">
                            <p class="userProfile__lastSeen">
                                Son görünmə: {{ lastSeen }}
                            </p>
                        </div>

                        
                        
                    </div>

                </div>

            </div>

            <div class="my-5">
                <v-skeleton-loader
                    type="image"
                    v-if="loading"
                >
                </v-skeleton-loader>
                
                <UserProfileMain :userName="localUser.name" v-show="localUser && !loading"/>
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

import UserProfileMain from '../components/UserProfileMain.vue'
export default {
    components: { UserProfileMain },
    data() {
        return {
            loading: true,
            localUser: {},
            // authorized: false,

            avatarSize: '11rem',
            online: false,

            userNotFound: false,

            editProfileBtnVisible: true,
            editProfileFormVisible: false,

            editForm: {
                name: '',
                email: '',
                phone_number: '',
                password: '',
            },

            avatar: '',

            confirmPasswordVisible: false,

            nameRules: [
                v => !!v || 'Ad tələb olunur',
                // v => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
            emailRules: [
                v => !!v || 'E-mail tələb olunur',
                v => /.+@.+\..+/.test(v) || 'E-mail adresi etibarlı deyil',
            ],
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
            if(res) {
                this.loading = false
            }
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
        },

        openEditProfile() {
            this.editProfileBtnVisible = false
            this.editProfileFormVisible = true
        },

        closeEditForm() {
            this.editProfileFormVisible = false
            this.editProfileBtnVisible = true
        },

        submitEditForm() {
            this.loading = true

            let token = localStorage.getItem('sanctum_token');

            axios.put(`/api/user/${this.$route.params.id}`, this.editForm, {
                headers: {
                    'Authorization': 'Bearer '+ token
                }
            })
            .then((response) => {
                console.log(response)
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loading = false
            })
        },

        fileInputOnChange(e) {
            this.avatar = e.target.files[0]
            // this.formData.images = e.target.files[0]
            console.log(e.target.files[0])

            const form = this.$refs.submitAvatarBtn
            form.click()
        },

        submitAvatarForm() {
            this.loading = true

            let avatarFormData = new FormData()
            avatarFormData.append('avatar', this.avatar)

            let token = localStorage.getItem('sanctum_token')

            axios.put(`/api/user/${this.$route.params.id}/avatar`, avatarFormData, {
                headers: {
                    'Authorization': 'Bearer '+token,
                }
            })
            .then((response) => {
                console.log(response)
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loading = false
            })
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
        },

        userRole() {
            const role = this.localUser.role
            if(role=='administrator') {
                return 'Administrator'
            }
            else if (role=='moderator') {
                return 'Moderator'
            }
            else {
                return 'İstifadəçi'
            }
        }
    },
    mounted() {
        this.getUser(this.$route.params.id)
        console.log(this.authorized)

        axios.get(`/api/user/${this.$route.params.id}`)
        .then((response) => {
            console.log(response)
            this.editForm.name = response.data.name
            this.editForm.email = response.data.email
            this.editForm.phone_number = response.data.phone_number
        })
        .catch((err) => {
            console.log(err)
        })
        .finally(() => {
            
        })
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
    bottom: 3%;
    right: 3%;

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

    font-size: 1rem;
    font-weight: 300;
}

.userProfile__lastSeen {
    font-size: 0.9rem;
}

.userProfile__agencyName {
    font-size: 1.1rem;
}
</style>