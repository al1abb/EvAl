<template>
    <div class="container-sm d-flex flex-wrap justify-content-between align-items-center py-4">
        <div style="max-width: 50rem;">
            <p>Data Ətraflı:</p>
            <p>{{ description }}</p>
        </div>

        <div style="background-color: #E4E4E4;" class="userInfo p-2">
            <div>
                <p class="username">
                    <router-link
                        :to="`/user/${user.id}`"
                    >
                        <div class="d-flex align-items-center">
                            <img
                                :src="userProfileImage"
                                :alt="`${user.name}`"
                                width="50"
                                height="50"
                            >
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
                <div v-if="realtor=='Agent'">
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
            userAgency: {}
        }
    },
    methods:{
        getUserAgency() {
            axios.get(`/api/user/${this.user.id}/agency`)
            .then((response) => {
                this.userAgency = response.data
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
        }
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