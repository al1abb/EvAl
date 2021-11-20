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
                :loading="loadingVip"
                :isVip="true"
                :isAgency="false"
            />

            <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">

            <PostSection
                title="Bütün Elanlar"
                :responseData="allData"
                :loading="loadingAll"
                :isVip="false"
                :isAgency="false"
            />

            <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">

            <PostSection
                title="Agentlik elanları"
                :responseData="agencyPosts"
                :loading="loadingAgency"
                :isVip="false"
                :isAgency="true"
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
            agencyPosts: [],
            currentPageDefault: 1,
            loadingVip: true,
            loadingAll: true,
            loadingAgency: true,
            isFirstPage: true,
            isLastPage: false,
            lastPage: 0,
        }
    },
    methods: {
        async handleAllListings() {
            // this.$store.commit('setSearchLoading', true)
            // this.handleVipPosts()
            // this.handleListings()
            // this.handleAgencyPosts()

            // this.$store.commit('setSearchLoading', true)
            this.loadingVip=true
            const vip = await axios.get('/api/posts/vip/son-ay?page=' + this.currentPageDefault)
            console.log(vip.data)
            this.vipData = vip.data.data
            this.loadingVip=false

            this.loadingAll=true
            const all = await axios.get('/api/posts?page=' + this.currentPageDefault)
            console.log(all.data) // chaining 'data' to this fixes bug
            this.allData = all.data.data
            this.currentPageDefault = all.data.current_page
            this.isFirstPage = all.data.prev_page_url ? false : true
            this.isLastPage = all.data.next_page_url ? false : true
            this.lastPage = all.data.last_page
            this.loadingAll=false

            this.loadingAgency=true
            const agency = await axios.get('/api/posts/agentlikler?page=' + this.currentPageDefault)
            console.log(agency.data)
            this.agencyPosts = agency.data.data
            this.loadingAgency=false

            // this.$store.commit('setSearchLoading', false)
        },

        prevPage() {
            this.currentPageDefault--
            this.handleListings()
        },
        nextPage() {
            this.currentPageDefault++
            this.handleListings()
        },
        scrollToTop() {
            window.scrollTo(0,0);
        }
    },
    computed: {
        ...mapState([
            "searchLoading",
            "searchData",
        ]),
    },
    mounted() {
        this.handleAllListings()
    },
    watch: {
        currentPageDefault: function() {
            this.handleAllListings()
            this.scrollToTop()
        },
    }
}
</script>

<style>

</style>