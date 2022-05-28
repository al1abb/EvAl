<template>
    <div>
        <!-- <pre>
            {{ flag }}
        </pre> -->

        <div class="flag">
            <p class="flag__reasonLabel">
                Səbəb
            </p>
            
            <p class="flag__reason my-3">
                {{ flag.flag_reason }}
            </p>

            <div class="d-flex justify-content-between">
                <div>
                    <p class="flag__timestamp">
                        {{ createdAt }}
                    </p>
                </div>

                <div>
                    <v-btn
                        icon
                        color="red"
                        @click="deleteFlag(flag.id)"
                    >
                        <v-icon>
                            mdi-delete
                        </v-icon>
                    </v-btn>

                    <v-btn
                        icon
                        color="green"
                        @click="redirectToPost(flag.post_id)"
                    >
                        <v-icon>
                            mdi-arrow-right
                        </v-icon>
                    </v-btn>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["flag"],
    data() {
        return {
            
        }
    },
    methods: {
        deleteFlag(flagId) {
            const token = localStorage.getItem("sanctum_token")

            axios.delete(`/api/flag/${flagId}`, {
                headers: {
                    'Authorization': 'Bearer '+ token
                }
            })
            .then((res) => {
                console.log("DELETED FLAG")
                console.log(res)
            })
            .catch((err) => {
                console.log(err)
            })
        },
        redirectToPost(postId) {
            this.$router.push(`/post/${postId}`)
        }
    },
    computed: {
        createdAt() {
            return `${this.flag.created_at.slice(8, 10)}-${this.flag.created_at.slice(5,7)}-${this.flag.created_at.slice(0, 4)}`
        }
    }
}
</script>

<style>
.flag {
    background-color: #E5E5E5;
    border-radius: 15px;

    min-height: 7rem;

    padding: 1rem;
}

.flag__reasonLabel {
    font-size: 1.1rem;
    font-weight: 600;
}

.flag__reason {
    font-size: 1.1rem;
    font-weight: 400;
}

.flag__timestamp {

}
</style>