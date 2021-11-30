<template>
    <div class="container-sm">
        This is agency page {{ $route.params.id }}

        <p style="font-size: 1.1rem; font-weight: 600;">
            {{ agencyData.agency_name }}
        </p>

        <p>
            {{ agencyData.agency_description }}
        </p>

        <pre>
            {{ agencyData }}
        </pre>
    </div>
</template>

<script>
export default {
    data() {
        return {
            agencyData: {}
        }
    },
    methods: {
        getAgencyData(id) {
            axios.get(`/api/agency/${id}`)
            .then((response) => {
                console.log(response)
                this.agencyData = response.data
            })
            .catch((err) => {
                console.log(err)
            })
        }
    },
    mounted() {
        this.getAgencyData(this.$route.params.id)
    }
}
</script>

<style>

</style>