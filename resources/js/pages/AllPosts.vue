<template>
	<div>

        <div class="text-center mb-3">
            Current page is {{ currentPage }}
        </div>

        <PostSection 
            title="VIP Posts"
            :responseData="vipData"
            :loading="loading"
        />

        <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">

        <PostSection 
            title="All Posts"
            :responseData="allData"
            :loading="loading"
        />

        <v-pagination
            v-model="currentPage"
            :length="lastPage"
            :disabled="loading"
            class="my-5"
        >
        </v-pagination>

    </div>
</template>

<script>
import axios from 'axios';

import Post from '../components/Post.vue';
import PostSection from '../components/PostSection.vue';

export default {
	components: { Post, PostSection },
	data() {
        return {
            allData: [],
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
                    this.allData = response.data.data
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
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    this.loading = false
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
        this.handleVipPosts()
        this.handleListings()
    },
    watch: {
        currentPage: function() {
            this.handleListings()
        }
    }
}
</script>

<style>

</style>