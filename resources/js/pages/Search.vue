<template>
    <div>

        <div class="text-center mb-3">
            Current page is somePage {{ searchLoading }} Loading
        </div>

        <div class="container-sm mb-2">
            <div class="" style="width: auto;">

                <div style="height: auto; display: flex; flex-direction: column; justify-content: center;">
                    <v-skeleton-loader
                        v-if="searchLoading"
                        type="heading"
                        max-width="25rem"
                        class="my-2"
                    >
                    </v-skeleton-loader>

                    <p style="font-size: 1.1rem;" v-if="!searchLoading && searchResponse.allPosts"><b>{{ vipPostCount }}</b> VİP, <b>{{ voucherPostCount }}</b> Kupçalı olmaqla toplam <b>{{ totalPostCount }}</b> elan tapıldı.</p>

                    <p style="font-size: 1.1rem;" v-if="!searchLoading && searchResponse.allPostsCount==0">No Results Found</p>
                   
                </div>

            </div>
        </div>

        <div v-if="searchResponse.allPostsCount">
            <PostSection
                title="VİP Elanlar"
                :responseData="searchResponse.vipPosts.data"
                :loading="searchLoading"
            />
            <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">
            <PostSection
                title="Bütün Elanlar"
                :responseData="searchResponse.allPosts.data"
                :loading="searchLoading"
            />
            <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">
            <PostSection
                title="Kupçalı Əmlaklar"
                :responseData="searchResponse.voucherPosts.data"
                :loading="searchLoading"
            />
        </div>

    </div>
</template>

<script>
import { mapState } from 'vuex';
import PostSection from '../components/PostSection.vue';
export default {
    components: { PostSection },
    data() {
        return {
            searchResponse: {}
        }
    },
    methods: {
        handleSearch() {
            console.log("in handleSearch")
            // this.$store.commit('setSearchLoading', true)

            console.log("this is search page params")
            console.log(this.$route.params)

            console.log("this is search page query")
            console.log(this.$route.query)

            this.searchResponse = this.searchData.data
            console.log("this is searchResponse")
            console.log(this.searchResponse)
            this.$store.commit('setSearchLoading', false)
        },
    },
    computed: {
        ...mapState([
            "searchLoading",
            "searchData",
        ]),

        totalPostCount() {
            if(this.searchResponse.allPosts) {
                return this.searchResponse.allPostsCount;
            }
        },
        vipPostCount() {
            if(this.searchResponse.allPosts) {
                return this.searchResponse.vipPostsCount;
            }
        },
        voucherPostCount() {
            if(this.searchResponse.allPosts) {
                return this.searchResponse.voucherPostsCount;
            }
        }
    },
    mounted() {
        this.handleSearch()
    },
    // watch: {
    //     searchData: function() {
    //         this.handleSearch()
    //     }
    // }
    watch:{
        $route (to, from){
            this.handleSearch()
        },
        searchData() {
            this.searchResponse = this.searchData.data
        }
    } 
}
</script>

<style>

</style>