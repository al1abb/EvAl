<template>
	<div>
        <div class="text-center">
            This is home page
        </div>

        <div class="text-center">
            Current page is {{ currentPage }}
        </div>

        <section class="container-sm">
            <!-- v-container had these classes d-flex flex-wrap -->
            <v-container class="">
                <div class="d-flex justify-content-between mb-3" v-show="!loading">
                    <v-btn v-if="!firstPage" :disabled="loading" @click="prevPage"> Back </v-btn>
                    <v-btn v-if="!lastPage" :disabled="loading" @click="nextPage"> > </v-btn>        
                </div>

                <v-row>
                    <v-col class="d-flex justify-content-center" v-for="(listing, i) in responseData" :key="i"
                        lg="3"
                        md="6"
                        sm="12"
                    >
                        <v-skeleton-loader
                            :loading="loading"
                            type="card"
                            min-width="16rem"
                            max-width="16rem"
                        >
                            <Post 
                                :id="listing.id"
                                :user="listing.user"
                                :city="listing.estate_city"
                                :district="listing.estate_district"
                                :type="listing.estate_type"
                                :area="listing.estate_area"
                                :roomCount="listing.estate_roomCount"
                                :description="listing.estate_description"
                                :price="listing.estate_price"
                                :createdAt="listing.created_at"
                                :loading="loading"
                            />
                        </v-skeleton-loader>
                    </v-col>
                </v-row>

            </v-container>

        </section>    
        
    </div>
</template>

<script>
import axios from 'axios';

import Post from '../components/Post.vue';

export default {
	components: { Post },
	data() {
        return {
            responseData: [],
            currentPage: 1,
            loading: true,
            firstPage: true,
            lastPage: false,
        }
    },
    methods: {
        handleListings() {
            //this.toggleListings()
            this.loading = true
            axios.get('/api/posts?page=' + this.currentPage)
                .then((response) => {
                    console.log(response.data) // chaining 'data' to this fixes bug
                    this.responseData = response.data.data
                    this.currentPage = response.data.current_page
                    this.firstPage = response.data.prev_page_url ? false : true
                    this.lastPage = response.data.next_page_url ? false : true
                    // console.log(this.responseData[0].estate_district)
                })
                .catch((err) => {
                    console.log(err)
                })
                .finally(() => {
                    setTimeout(() => {
                        this.loading = false
                    }, 500)
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