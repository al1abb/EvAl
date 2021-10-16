<template>
    <div>
        <!-- {{ post }} -->
        <div v-if="loading">LOADING</div>
        <div v-show="!loading">
            <p>id: {{ post.id }}</p>
            <p>type: {{ post.estate_type }}</p>
            <p>city: {{ post.estate_city }}</p>
            <p>area: {{ post.estate_area }}</p>
            <p>description: {{ post.estate_description }}</p>
            <p>price: {{ post.estate_price }}</p>
            <p>address: {{ post.estate_address }}</p>
            <p>district: {{ post.estate_district }}</p>
            <p>viewsTotal: {{ post.estate_viewsTotal }}</p>
            <p>viewsToday: {{ post.estate_viewsToday }}</p>
            <p>roomCount: {{ post.estate_roomCount }}</p>
            <p>apartmentFloor: {{ post.estate_apartmentFloor }}</p>
            <p>tradeType: {{ post.estate_tradeType }}</p>
            <p>user: {{ post.user }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            post: {},
            loading: false
        }
    },
    mounted () {
        this.fetchData()
    },
    methods: {
        fetchData() {
            this.loading = true
            const fetchId = this.$route.params.id

            axios.get('/api/posts/' + fetchId)
                .then((response) => {
                    this.post = response.data
                    console.log(this.post)
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