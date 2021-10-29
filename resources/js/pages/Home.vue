<template>
	<div>
        <div class="text-center">
            This is home page
        </div>

        <div class="text-center">
            Current page is {{ currentPage }}
        </div>

        <section class="">
            <!-- v-container had these classes d-flex flex-wrap -->
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div v-show="!loading" 
                    class="d-flex justify-content-center align-items-center mb-4" 
                    style="background-color: white; height: 5rem; width: 70%; text-align: center; border-radius: 5px;"
                >
                    <span class="section-header">ALL POSTS</span>
                </div>

                <!-- Simple initial pagination -->
                <!-- <div class="d-flex justify-content-between mb-3" v-show="!loading">
                    <v-btn v-if="!isFirstPage" :disabled="loading" @click="prevPage"> Back </v-btn>
                    <v-btn v-if="!isLastPage" :disabled="loading" @click="nextPage"> > </v-btn>        
                </div> -->

                <v-pagination
                    v-model="currentPage"
                    :length="lastPage"
                    :disabled="loading"
                    class="mb-3"
                >
                </v-pagination>

                <div style="width: 60%;">
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 1rem;">
                        <div class="d-flex justify-content-center" v-for="(listing, i) in responseData" :key="i"
                            lg="3"
                            md="6"
                            sm="12"
                        >
                            <v-skeleton-loader
                                :loading="loading"
                                type="card"
                                min-width="14.5rem"
                                max-width="14.5rem"
                            >
                                <Post 
                                    :id="listing.id"

                                    :user="listing.user"
                                    :agency="listing.agency"

                                    :type="listing.estate_type"

                                    :city="listing.city"
                                    :area="listing.area"
                                    :roomCount="listing.room_count"
                                    :address="listing.address"
                                    :district="listing.district"
                                    
                                    :apartmentFloor="listing.apartment_floor"
                                    :totalFloors="listing.total_floors"
                                    
                                    :price="listing.price"

                                    :isVip="listing.is_vip"
                                    :hasVoucher="listing.has_voucher"
                                    
                                    :createdAt="listing.created_at"
                                    :loading="loading"
                                />
                            </v-skeleton-loader>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">

        <section>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div v-show="!loading" 
                    class="d-flex justify-content-center align-items-center mb-4" 
                    style="background-color: white; height: 5rem; width: 70%; text-align: center; border-radius: 5px;"
                >
                    <span class="section-header">VIP POSTS</span>
                </div>

                <div style="width: 60%;">
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-around; gap: 1rem;">
                        <div class="d-flex justify-content-center" v-for="(listing, i) in vipData" :key="i">
                            <v-skeleton-loader
                                :loading="loading"
                                type="card"
                                min-width="14.5rem"
                                max-width="14.5rem"
                            >
                                <Post 
                                    :id="listing.id"

                                    :user="listing.user"
                                    :agency="listing.agency"

                                    :type="listing.estate_type"

                                    :city="listing.city"
                                    :area="listing.area"
                                    :roomCount="listing.room_count"
                                    :address="listing.address"
                                    :district="listing.district"
                                    
                                    :apartmentFloor="listing.apartment_floor"
                                    :totalFloors="listing.total_floors"
                                    
                                    :price="listing.price"

                                    :isVip="listing.is_vip"
                                    :hasVoucher="listing.has_voucher"
                                    
                                    :createdAt="listing.created_at"
                                    :loading="loading"
                                />
                            </v-skeleton-loader>
                        </div>
                    </div>
                </div>
            </div>
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
            vipData: [],
            currentPage: 1,
            loading: true,
            isFirstPage: true,
            isLastPage: false,
            lastPage: 0
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
                    this.isFirstPage = response.data.prev_page_url ? false : true
                    this.isLastPage = response.data.next_page_url ? false : true
                    this.lastPage = response.data.last_page
                    // console.log(this.lastPage)
                    // console.log(this.responseData[0].estate_district)
                })
                .catch((err) => {
                    console.log(err)
                })
                .finally(() => {
                    this.loading = false
                })
        },

        handleVipPosts() {
            this.loading = true;
            axios.get('/api/posts/vip')
                .then((response) => {
                    console.log(response.data)
                    this.vipData = response.data.data
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
        this.handleVipPosts()
    },
    watch: {
        currentPage: function() {
            this.handleListings()
        }
    }
}
</script>

<style>
.section-header {
    font-size: 1.0rem;
    font-weight: 600;
}
</style>