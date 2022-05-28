<template>
    <div class="container-sm">
        <div v-if="!loading">
            <p>Agencies</p>
            <div 
                v-for="(agency, i) in agencies" 
                :key="i" 
                class="p-4 my-4" 
                style="max-width: 35rem; border-radius: 25px; background-color: #D5D5D5"
            >
                <div
                    @click="goToAgencyPage(agency.id)"
                    style="cursor: pointer;"
                >
                    <p style="font-weight: 600">{{ agency.agency_name }}</p>
                    <p>{{ agency.agency_description }}</p>
                </div>

                <p 
                    class="mt-10 px-4 py-1"
                    @click="deleteAgency(agency.id)"
                    style="cursor: pointer; color: red; border: 1px solid red; border-radius: 7px; width: fit-content; z-index: 9"
                >
                    Delete
                </p>
            </div> 
        </div>

        <div v-if="loading">
            Loading...
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            agencies: [],

            loading: false
        }
    },
    methods: {
        fetchAgencies() {
            this.loading = true

            axios.get('/api/agencies', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem("sanctum_token")
                }
            })
            .then((res) => {
                console.log(res)

                this.agencies = res.data.data
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loading = false
            })
        },

        goToAgencyPage(agencyId) {
            this.$router.push(`/agency/${agencyId}`)
        },

        deleteAgency(agencyId) {
            this.loading = true

            axios.delete(`/api/agency/${agencyId}`, {
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
        this.fetchAgencies()
    }
}
</script>

<style>

</style>