<template>
	<div>

        <div class="text-center mb-3">
            Current page is {{ currentPageDefault }} {{ searchLoading }} Loading
        </div>

        
        <div class="container-sm mb-2">
            <div class="" style="width: auto;">

                <div style="height: 1.5rem; display: flex; flex-direction: column; justify-content: center;">
                    <v-skeleton-loader
                        v-if="searchLoading"
                        type="heading"
                        max-width="25rem" 
                        class="mt-auto"
                    >
                    </v-skeleton-loader>

                    <p style="font-size: 1.1rem;" v-if="!searchLoading">Ən son elanlar</p>
                   
                </div>

            </div>
        </div>

        <div v-if="allData">
            <PostSection
                title="VİP Elanlar"
                :responseData="vipData"
                :loading="searchLoading"
            />

            <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">


            <PostSection
                title="Bütün Elanlar"
                :responseData="allData"
                :loading="searchLoading"
            />
        </div>

        <div v-else>
            No Result
        </div>

        <div class="my-10">
            <v-pagination
                v-if="allData"
                v-model="currentPageDefault"
                :length="lastPage"
                total-visible="10"
                :disabled="searchLoading" 
            >
            </v-pagination>
        </div>

    </div>
</template>

<script>
import { mapState } from 'vuex';
import axios from 'axios';

import PostSection from '../components/PostSection.vue';

export default {
	components: { PostSection },
	data() {
        return {
            allData: [],
            vipData: [],
            currentPageDefault: this.$route.query.page,
            loading: true,
            isFirstPage: true,
            isLastPage: false,
            lastPage: 0,
        }
    },
    methods: {
        handleListings() {
            //this.toggleListings()
            this.$store.commit('setSearchLoading', true)
            axios.get('/api/posts?page=' + this.currentPageDefault)
                .then((response) => {
                    this.$router.push({ 
                        name: 'home',
                        // params: response.data,
                        query: {
                            'page': this.currentPageDefault,
                        }
                    })
                    
                    console.log(response.data) // chaining 'data' to this fixes bug
                    this.allData = response.data.data
                    this.currentPageDefault = response.data.current_page
                    this.isFirstPage = response.data.prev_page_url ? false : true
                    this.isLastPage = response.data.next_page_url ? false : true
                    this.lastPage = response.data.last_page

                })
                .catch((err) => {
                    console.log(err)
                })
                .finally(() => {
                    this.$store.commit('setSearchLoading', false)
                })
        },

        handleVipPosts() {
            this.$store.commit('setSearchLoading', true)
            axios.get('/api/posts/vip')
                .then((response) => {
                    console.log(response.data)
                    this.vipData = response.data.data
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    this.$store.commit('setSearchLoading', false)
                })
        },

        prevPage() {
            this.currentPageDefault--
            this.handleListings()
        },
        nextPage() {
            this.currentPageDefault++
            this.handleListings()
        }
    },
    computed: {
        ...mapState([
            "searchLoading",
            "searchData",
        ]),
    },
    mounted() {
        this.handleVipPosts()
        this.handleListings()
    },
    watch: {
        currentPageDefault: function() {
            this.handleListings()
        },
    }
}
</script>

<style>

</style>