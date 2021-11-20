<template>
	<div>
        <div class="text-center mb-3">
            Current page is {{ currentPage }}
        </div>

        <div class="mb-10">
            <PostSection
                v-scroll="handleScroll"
                title="VİP Elanlar"
                :responseData="vip"
                :loading="loadingVip"
                :isVip="true"
                :isAgency="false"
            />
        </div>

        <div class="d-flex justify-content-center text-center my-10">
            <!-- <HollowDotsSpinner
                v-show="nextLoading && !isVipLastPage"
                :animation-duration="500"
                :dot-size="15"
                :dots-num="3"
                color="#ff1d5e"
            /> -->
            <div v-show="nextLoading && !isVipLastPage" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>

        <!-- <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">

        <PostSection 
            title="All Posts"
            :responseData="allData"
            :loading="loadingAll"
        />
        
        <hr style="border: none; margin-top: 5rem; margin-bottom: 5rem;">

        <PostSection 
            title="Agency Posts"
            :responseData="agencyPosts"
            :loading="loadingAgency"
        /> -->

        <!-- <div class="my-10">
            <v-pagination
                v-if="allData"
                v-model="currentPage"
                :length="lastPage"
                total-visible="10" 
            >
            </v-pagination>
        </div> -->

    </div>
</template>

<script>
import axios from 'axios';

import Post from '../components/Post.vue';
import PostSection from '../components/PostSection.vue';

import { HollowDotsSpinner } from 'epic-spinners';

export default {
	components: { Post, PostSection, HollowDotsSpinner },
	data() {
        return {
            allData: [],
            vipData: [],
            agencyPosts: [],
            currentPage: 1,
            loadingVip: true,
            loadingAll: true,
            loadingAgency: true,
            nextLoading: false,
            isFirstPage: true,
            isLastPage: false,
            lastPage: 0,

            isVipLastPage: false,
            vipLastPage: 0,
        }
    },
    methods: {
        async handleAllListings() {
            this.loadingVip=true
            const vip = await axios.get('api/posts/vip?page=' + this.currentPage)
            console.log(vip.data)
            this.vipData = vip.data.data
            this.loadingVip=false

            this.loadingAll=true
            const all = await axios.get('/api/posts?page=' + this.currentPage)
            console.log(all.data) // chaining 'data' to this fixes bug
            this.allData = all.data.data
            this.currentPage = all.data.current_page
            this.isFirstPage = all.data.prev_page_url ? false : true
            this.isLastPage = all.data.next_page_url ? false : true
            this.lastPage = all.data.last_page
            this.loadingAll=false

            this.loadingAgency=true
            const agency = await axios.get('/api/posts/agentlikler?page=' + this.currentPage)
            console.log(agency.data)
            this.agencyPosts = agency.data.data
            this.loadingAgency=false
        },

        async loadNextVipPosts() {
            if(this.currentPage != this.vipLastPage) {
                this.currentPage+=1
                const vip = await axios.get('api/posts/vip?page=' + this.currentPage)
                console.log(vip.data)
                this.vipData.push(...vip.data.data)
                
                this.vipLastPage = vip.data.last_page
            }
            else {
                this.isVipLastPage = true
            }

            this.nextLoading = false
        },

        handleScroll (event) {
            window.onscroll = async() => {
                let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight === document.documentElement.offsetHeight

                if (bottomOfWindow) {
                    if(this.current != this.vipLastPage) {
                        this.nextLoading = true
                        // this.scrollToBottom()
                    }

                    setTimeout(async() => {
                        await this.loadNextVipPosts()
                    }, 500)
                }
            }
        },

        prevPage() {
            this.currentPage--
            this.handleAllListings()
        },
        nextPage() {
            this.currentPage++
            this.handleAllListings()
        },
        scrollToTop() {
            window.scrollTo(0,0);
        },
        scrollToBottom() {
            window.scrollTo(0, document.documentElement.offsetHeight)
        }
    },
    computed: {
        vip() {
            return this.vipData
        }
    },
    mounted() {
        this.handleAllListings()
    },
    // created () {
    //     window.addEventListener('scroll', this.handleScroll);
    // },
    // destroyed () {
    //     window.removeEventListener('scroll', this.handleScroll);
    // },
}
</script>

<style>
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #ff1d5e;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}
</style>