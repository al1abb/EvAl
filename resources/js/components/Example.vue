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
        <div>
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
            Current page : {{ currentPage }}
            <p v-if="!firstPage"><a @click="prevPage">Previous Page</a></p>
            <p v-if="!lastPage"><a @click="nextPage">Next page</a></p>
            
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            count: 0,
            showListings: false,
            responseData: [],
            currentPage: 1,
            firstPage: true,
            lastPage: false
        }
    },
    methods: {
        toggleListings() {
            this.showListings=!this.showListings
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
        },
        prevPage() {
            this.currentPage--
            this.handleListings()
        },
        nextPage() {
            this.currentPage++
            this.handleListings()
        }
    },
    mounted() {
        this.handleListings()
    }
}
</script>

<style>

</style>