<template>
    <div class="container-sm d-flex flex-wrap justify-content-between py-4">
        <div style="max-width: 50rem;">
            <p>Data Ətraflı:</p>
            <p>{{ description }}</p>
        </div>

        <div style="background-color: #E4E4E4;" class="userInfo p-2">
            <div>
                <p class="username">
                    <router-link
                        :to="`/istifadeciler/@${user.name}`"
                    >
                        <v-avatar
                            
                        >
                            <v-img
                                :src="`/storage/avatars/${user.avatar}`" 
                                :alt="`${user.name}`"
                            >

                            </v-img>
                        </v-avatar>
                        {{ user.name }}
                    </router-link>
                </p>
                <p class="post_realtor">{{ realtor }}</p>
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
        }
    },
    computed: {
        realtor() {
            return this.realtorType=='self' ? "Mülk sahibi" : "Agent"
        }
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