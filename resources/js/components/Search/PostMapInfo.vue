<template>
    <div>
        <div v-if="!loading && this.postData.price!=undefined">
            <div class="d-flex" @click="goToPostPage" style="cursor: pointer;">
                <div>
                    <v-img 
                        :width="postMediaSize.width"
                        :height="postMediaSize.height"
                        :src="computedPostMedia" 
                        alt=""
                        position="center center"
                        style="border-radius: 10px;"
                        aspect-ratio="1.7778"
                    />
                </div>

                <div class="postInfo d-flex flex-column justify-content-between ml-2" style="max-width: 15rem;" v-if="postData">
                    <p class="postInfo__head">
                        <!-- Nərimanov, Koroğlu 105 -->
                        {{ computedPostHead }}
                    </p>

                    <p class="postInfo__body">
                        <!-- 3 otaq, 70 m², 5/5 mərtəbə -->
                        <b>{{ computedPostEstateType }} {{ computedPostTradeType }}</b>
                        <br>
                        {{ computedPostBody }}
                    </p>

                    <p class="postInfo__price">
                        <!-- 120 000 ₼ -->
                        {{ computedPostPrice }}
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <v-icon 
                        v-if="computedPostData.is_vip"
                        class="mx-1" 
                        color="red"
                        title="VİP Post"
                    >
                        mdi-crown
                    </v-icon>

                    <v-icon 
                        v-if="computedPostData.agency_id && computedPostData.realtor_type == 'agent'"
                        class="mx-1" 
                        color="primary"
                        title="Agentlik"
                    >
                        mdi-domain
                    </v-icon>
                </div>

                <div>
                    <v-btn
                        @click="handlePostLinkCopy"
                        icon
                    >
                        <v-icon
                            title="Elan linkini kopyalayın"
                        >
                            mdi-content-copy
                        </v-icon>

                            <!-- <v-snackbar
                                v-model="linkCopySnackbar"
                                :timeout="3000"
                                absolute
                                bottom
                                elevation="5"
                                max-height="20px"
                                class="no-uppercase"
                            >
                                Link kopyalandı
                            </v-snackbar> -->
                    </v-btn>
                    <v-btn 
                        @click="handleSave"
                        icon
                        :style="isPostSaved ? 'text-fill-color: #77A43D;' : 'text-fill-color: #00000050;'"
                    >
                        <v-icon
                            color="#00000090"
                            :title="isPostSaved ? 'Yaddaşdan sil' : 'Yadda saxla'"
                        >
                            mdi-bookmark
                        </v-icon>
                    </v-btn>
                </div>

            </div>
        </div>
        <div v-else>
            Loading...
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
export default {
    props: ["postId", "postData"],
    data() {
        return {
            postMedia: "",
            postMediaSize: {
                width: 150,
                height: 113
            },

            loading: null,

            // link copy, snackbar
            linkCopySnackbar: false,
            linkCopyStatus: '',
        }
    },
    methods: {
        ...mapActions(["savePost", "unsavePost"]),

        handlePostLinkCopy() {
            this.linkCopySnackbar = true
             
            let route = this.$router.resolve({
                path: `/post/${this.postId}`
            })

            // window.navigator.clipboard.writeText(route);
            // this.linkCopyStatus = 'copied'
        },

        handleSave() {
            if(this.isPostSaved == false) {
                this.savePost(this.postId)
            }
            else {
                this.unsavePost(this.postId)
            }
        },

        getPostMedia(id) {
            this.loading = true

            axios.get(`/api/post/${id}/media`)
            .then((res) => {
                console.log(res)
                this.postMedia = res.data.original_url
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loading = false
            })
        },

        goToPostPage() {
            let route = this.$router.resolve({
                path: `/post/${this.postId}`
            })
            window.open(route.href, '_blank')
        },
    },
    mounted() {
        // this.getPostMedia(this.postId)
    },
    computed: {
        ...mapState(["savedPosts"]),

        computedPostMedia() {
            return this.postMedia ?? `https://picsum.photos/id/${this.postId}/200/300`
        },

        computedPostData() {
            return this.postData;
        },
        
        computedPostHead() {
            return `${this.postData.district}, ${this.postData.address}`
        },

        computedPostEstateType() {
            const estateType = this.postData.estate_type
            if(estateType == 'apartment') {
                return 'Mənzil'
            }
            else if(estateType == 'new_apartment') {
                return 'Yeni mənzil'
            }
            else if(estateType == 'house_villa') {
                return 'Ev-Villa'
            }
            else if(estateType == 'office') {
                return 'Ofis'
            }
            else if(estateType == 'garage') {
                return 'Qaraj'
            }
            else if(estateType == 'land') {
                return 'Torpaq'
            }
            else {
                return 'Undefined'
            }
        },

        computedPostTradeType() {
            const tradeType = this.postData.trade_type
            if(tradeType == 'sell') {
                return 'satılır'
            }
            else if(tradeType == 'rent') {
                return 'kirayə verilir'
            }
            else {
                return 'Undefined'
            }
        },

        computedPostBody() {
            if(this.postData.room_count == 0 && this.postData.apartment_floor == 0) {
                return `${this.postData.area} m²`
            }
            return `${this.postData.room_count} otaq, ${this.postData.area} m², ${this.postData.apartment_floor}/${this.postData.total_floors} mərtəbə`
        },

        computedPostPrice() {
            return `${this.postData.price} ₼`
        },

        computedPostIsVip() {
            return this.postData.is_vip
        },

        computedPostHasAgency() {
            if(this.postData.agency_id != null) {
                return true
            }
            else return false
        },

        computedPostRealtorIsAgent() {
            if(this.postData.realtor_type == 'agent') {
                return true
            } 
            else {
                return false
            }
        },

        isPostSaved() {
            return this.savedPosts.includes(this.postId)
        }
    },
    watch: {
        postId() {
            this.getPostMedia(this.postId)
        }
    }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

.postInfo {
    max-width: 20rem;
}

.postInfo__head {
    color: #000000;

    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    font-weight: 400;
}

.postInfo__body {
    color: #888888;

    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    font-weight: 300;

    /* max-width: 10rem; */
}

.postInfo__price {
    color: #000000;

    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    font-weight: 700;
}
</style>