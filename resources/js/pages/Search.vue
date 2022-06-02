<template>
    <div>
        <!-- <div class="text-center mb-3">
            Current page is somePage {{ searchLoading }} Loading
        </div> -->

        <div class="container-sm mb-2">
            <div class="" style="width: auto">
                <div
                    style="
                        height: auto;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                    "
                >
                    <v-skeleton-loader
                        v-if="searchLoading"
                        type="heading"
                        max-width="25rem"
                        class="my-2"
                    >
                    </v-skeleton-loader>

                    <div v-if="!hasShowMap">
                        <p
                            style="font-size: 1.1rem"
                            v-if="!searchLoading && searchResponse.allPosts"
                        >
                            <b>{{ vipPostCount }}</b> VİP,
                            <b>{{ voucherPostCount }}</b> Kupçalı olmaqla toplam
                            <b>{{ totalPostCount }}</b> elan tapıldı.
                            <small style="color: gray"
                                >({{ responseTime }} s)</small
                            >
                        </p>

                        <p style="font-size: 1.1rem" v-if="!searchLoading">
                            <span v-if="searchResponse.allPostsCount == 0"
                                >No Results Found</span
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-10" v-if="!searchLoading && hasShowMap">
            <!-- Search Map component -->
            <SearchMap 
                :responseData="searchResponse.allPosts"
            />
        </div>

        <div class="mb-10" v-if="!searchLoading && !hasShowMap">
            <PostSection
                title="VİP Elanlar"
                :responseData="searchResponse.vipPosts.data"
                :loading="searchLoading"
                :isVip="true"
                :isAgency="false"
            />
            <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem" />
            <PostSection
                title="Bütün Elanlar"
                :responseData="searchResponse.allPosts.data"
                :loading="searchLoading"
                :isVip="false"
                :isAgency="false"
            />
            <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem" />
            <PostSection
                title="Çıxarışlı Əmlaklar"
                :responseData="searchResponse.voucherPosts.data"
                :loading="searchLoading"
                :isVip="false"
                :isAgency="false"
            />

            <!-- <div class="my-10">
                {{ lastPage }}
                <v-pagination
                    v-model="currentPageDefault"
                    :length="lastPage"
                    total-visible="10"
                    :disabled="searchLoading" 
                >
                </v-pagination>
            </div> -->

        </div>

    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import PostSection from "../components/PostSection.vue";
import SearchMap from "../components/Search/SearchMap.vue";

export default {
    components: { PostSection, SearchMap },
    data() {
        return {
            searchResponse: {},

            currentPageDefault: 1,
            lastPage: 0,

            isFirstPage: true,
            isLastPage: false,

            loading: null,
        };
    },
    methods: {
        ...mapActions([
            "search"
        ]),

        handleSearch() {
            console.log("in handleSearch");
            // this.$store.commit('setSearchLoading', true)

            console.log("this is search page params");
            console.log(this.$route.params);

            console.log("this is search page query");
            console.log(this.$route.query);

            // console.log("aaa")
            this.searchResponse = this.searchData.data;

            this.lastPage = this.searchResponse.allPosts.last_page

            console.log("this is searchResponse");
            console.log(this.searchResponse);
        },

        async handleSearchListings() {
            this.loading = true
            this.$store.commit('setSearchLoading', true)

            const res = await this.search(this.searchQueryStore, currentPageDefault)

            this.$store.commit('setSearchData', res)

            this.loading = false
            this.$store.commit('setSearchLoading', false)
        },

        prevPage() {
            this.currentPageDefault--
            this.handleSearchListings()
        },
        nextPage() {
            this.currentPageDefault++
            this.handleSearchListings()
        },

        scrollToTop() {
            window.scrollTo(0,0);
        }
    },
    computed: {
        ...mapState(["searchLoading", "searchQueryStore", "searchData"]),

        totalPostCount() {
            if (this.searchResponse.allPosts) {
                return this.searchResponse.allPostsCount;
            }
        },
        vipPostCount() {
            if (this.searchResponse.allPosts) {
                return this.searchResponse.vipPostsCount;
            }
        },
        voucherPostCount() {
            if (this.searchResponse.allPosts) {
                return this.searchResponse.voucherPostsCount;
            }
        },
        responseTime() {
            if (this.searchResponse.allPosts) {
                return (
                    Math.round(
                        (this.searchResponse.time + Number.EPSILON) * 100
                    ) / 100
                );
            }
        },

        hasShowMap() {
            return this.$route.query.mapCheckbox ? true : false;
        },
    },
    mounted() {
        this.handleSearch();
    },
    // watch: {
    //     searchData: function() {
    //         this.handleSearch()
    //     }
    // }
    watch: {
        $route(to, from) {
            this.handleSearch();
        },
        searchData() {
            this.searchResponse = this.searchData.data;
        },

        // currentPageDefault: function() {
        //     this.handleSearchListings()
        //     this.scrollToTop()
        // },
    },
};
</script>

<style></style>
