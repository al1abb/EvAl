<template>
    <div>
        <div class="container-sm">
            <form @submit.prevent="submitAddAgency" style="max-width: 20rem;">
                <v-text-field
                    v-model="agencyName"
                    solo
                    label="Agentlik adi"
                >
                </v-text-field>

                <v-text-field
                    v-model="agencyDescription"
                    solo
                    label="Agentlik haqqinda"
                ></v-text-field>

                <v-btn
                    type="submit"
                    class="no-uppercase"
                    :loading="loading"
                >
                    Yüklə
                </v-btn>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            agencyName: "",
            agencyDescription: "",

            loading: false
        }
    },
    methods: {
        submitAddAgency() {
            this.loading = true

            axios.post('/api/agencies', {
                agency_name: this.agencyName, 
                agency_description: this.agencyDescription
            }, {
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
                this.loading = false
            })
        }
    }
}
</script>

<style>

</style>