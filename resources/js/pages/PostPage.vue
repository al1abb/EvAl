<template>
    <div>
        <!-- {{ post }} -->
        <div v-if="loading">LOADING</div>
        <div v-show="!loading">
            <p>id: {{ post.id }}</p>
            <p>type: {{ post.estate_type }}</p>
            <p>city: {{ post.city }}</p>
            <p>area: {{ post.area }}</p>
            <p>description: {{ post.description }}</p>
            <p>price: {{ post.price }}</p>
            <p>address: {{ post.address }}</p>
            <p>district: {{ post.district }}</p>
            <p>viewsToday: {{ post.views_today }}</p>
            <p>viewsTotal: {{ post.views_total }}</p>
            <p>roomCount: {{ post.room_count }}</p>
            <p>apartmentFloor: {{ post.apartment_floor }}</p>
            <p>tradeType: {{ post.trade_type }}</p>
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

            axios.get('/api/post/' + fetchId)
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