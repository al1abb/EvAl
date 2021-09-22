<template>
    <div>
        <h4 class="text-center">Hello World!</h4>
        <h5>Hello</h5>
        <p>Count is {{ count }}</p>
        <button @click="count--">-</button>
            {{ count }}
        <button @click="count++">+</button>

        <hr>

        <button @click="handleListings">Show listings</button>
        <div v-if="showListings">
            <h3 style="text-align: center;">Estate-listings:</h3>
            <div v-for="(listing, i) in responseData" :key="i">
                <h3>{{ listing.id }})</h3>
                <p><b>City:</b> {{ listing.estate_city }}</p>
                <p><b>Type:</b> {{ listing.estate_type }}</p>
                <p><b>Area:</b> {{ listing.estate_area }} m² </p>
                <p><b>Description:</b> {{ listing.estate_description }} </p>
                <p><b>Price</b>: {{ listing.estate_price }} ₼ (AZN) </p>
                <p><a @click="handleDelete(listing.id)" style="cursor: pointer;">Delete</a></p>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            count: 0,
            showListings: false,
            responseData: []
        }
    },
    methods: {
        toggleListings() {
            this.showListings=!this.showListings
        },
        handleListings() {
            this.toggleListings()
            if(this.showListings) {
                axios.get('/api/posts')
                    .then((response) => {
                        console.log(response.data) // chaining 'data' to this fixes bug
                        this.responseData = response.data
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            }
        },
        handleDelete(id) {
            axios.delete(`/api/post/${id}`)
                .then((response) => {
                    console.log(response);
                    this.responseData = response.data
                })
                .catch((err) => {
                    console.log(err)
                })
                .finally(() => {
                    this.handleListings()
                })
        }
    },
}
</script>

<style>

</style>