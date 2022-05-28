<template>
    <div>
        <div v-if="!loading">
            <div v-if="!hasPageViewAccess">
                <p>You do not have privileges to view this page</p>
            </div>

            <div v-else>
                <div class="container-sm">
                    <div v-for="(flag, i) in flags.data" :key="i">
                        <Flag :flag="flag" />
                    </div>

                    <div v-if="flags.data.length == 0">
                        <p>There are no flags</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="container-sm">
                Loading...
            </div>
        </div>
    </div>
</template>

<script>
import Flag from "../components/Flag.vue";
import { mapState } from 'vuex';

export default {
    components: { Flag },
    data() {
        return {
            flags: [],

            loading: false,

            token: localStorage.getItem("sanctum_token")
        }
    },
    methods: {
        pageViewAccessCheck() {
            this.loading = true

            console.log("USER")
            console.log(this.user)
            if(this.user.role == 'administrator') {
                this.loading = false
                return true
            }
            else {
                this.loading = false
                return false
            }
        },
        fetchFlags() {
            this.loading = true

            axios.get('/api/flags', {
                headers: {
                    'Authorization': 'Bearer ' + this.token
                }
            })
            .then((res) => {
                console.log("fetchFlags() response in flagspage.vue")
                console.log(res.data)
                this.flags = res.data
            })
            .catch((err) => {
                console.log(err);
            })
            .finally(() => {
                this.loading = false
            })
        }
    },
    computed: {
        ...mapState(["authenticated", "user"]),

        localUser() {
            return JSON.parse(JSON.stringify(this.user))
        },

        hasPageViewAccess() {
            return this.pageViewAccessCheck()
        }
    },
    mounted() {
        this.fetchFlags()
    }
}
</script>

<style>

</style>