<template>
    <div class="container-sm d-flex flex-wrap justify-content-between align-items-start py-4">
        <div style="max-width: 50rem;">
            <div class="py-5">
                <h5 style="font-weight: 600;">Data Ətraflı:</h5>
                <p style="word-break: break-word;">{{ description }}</p>
            </div>
        </div>

        <div style="background-color: #E4E4E4;" class="userInfo p-2 mt-5">
            <div>
                <p class="username">
                    <router-link
                        :to="`/user/${user.id}`"
                    >
                        <div class="d-flex align-items-center">

                            <v-avatar
                                size="3rem"
                            >
                                <v-img
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7JvxfS8YsVlqnRbNFNx3b7t5UUsl4p_8V2A&usqp=CAU"
                                    :size="10"
                                    color="#919191"
                                    v-if="user.avatar == null"
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
                                <img
                                    v-if="user.avatar != null"
                                    :src="userProfileImage"
                                    :alt="`${user.name}`"
                                    width="50"
                                    height="50"
                                >
                            </v-avatar>
                            <p class="ml-1">{{ user.name }}</p>
                            <v-icon
                                v-if="user.email_is_verified"
                                color="#1C99FC"
                                class="ml-1"
                                small
                                title="Verified account"
                            >
                                mdi-check-decagram
                            </v-icon>
                        </div>
                    </router-link>
                </p>
                <p class="post_realtor">{{ realtor }}</p>
                <div v-if="realtor=='Agent' && userAgency.length">
                    <p>Şirkət: 
                        <router-link
                            :to="`/agency/${user.agency_id}`"
                        >
                            {{ userAgency.agency_name }}
                        </router-link>
                    </p>
                </div>
            </div>

            <div class="mt-2">
                Nömrə:
                <button v-if="!numberVisible" @click="numberVisible = true">Nömrəni göstər</button>
                <a v-show="numberVisible" :href="`tel:${phoneNumber}`">
                    <b>{{ phoneNumber }}</b>
                </a>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: ["description", "user", "phoneNumber", "realtorType"],
    data() {
        return {
            numberVisible: false,
            userAgency: {},
        }
    },
    methods:{
        getUserAgency() {
            axios.get(`/api/user/${this.user.id}/agency`)
            .then((response) => {
                this.userAgency = response.data;
            })
            .catch((err) => {
                console.log(err)
            })
        }
    },
    computed: {
        realtor() {
            return this.realtorType=='self' ? "Mülk sahibi" : "Agent"
        },
        userProfileImage() {
            return '../storage/' + this.user.avatar
        },
    },
    mounted() {
        this.getUserAgency()
    }
}
</script>

<style>
.userInfo {
    min-width: 12rem;
}

.username {
    font-size: 1rem;
}

.post_realtor {
    color: gray;
}
</style>