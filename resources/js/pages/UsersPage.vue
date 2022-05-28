<template>
    <div class="container-sm">
        <div v-if="loading">
            <p>Loading...</p>
        </div>
        <ul v-if="!loading">
            <li v-for="(user, i) in users" :key="i" class="my-5">
                <p>{{ user.name }}{{ ', ' + user.email }}{{ user.phone_number ? ', ' + user.phone_number : '' }}</p>

                <p style="color: red; cursor: pointer;" @click="deleteUser(user.id)">Delete</p>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            loading: false
        }
    },
    methods: {
        fetchUsers() {
            this.loading = true

            axios.get(`/api/users`, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem("sanctum_token")
                }
            })
            .then((res) => {
                console.log(res)
                this.users = res.data.data
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loading = false
            })
        },
        deleteUser(userId) {
            this.loading = true

            axios.delete(`/api/user/${userId}`, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem("sanctum_token")
                }
            })
            .then((res) => {
                console.log(res)
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.$router.go()
            })
        }
    },
    mounted() {
        this.fetchUsers()
    },
}
</script>

<style>

</style>