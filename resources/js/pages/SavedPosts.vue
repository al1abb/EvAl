<template>
    <div class="container-sm">

        <p style="font-size: 1.0rem; text-align: center; font-weight: 600;">
            İşarələnmiş Elanlar
        </p>

        <hr>

        <div class="mt-5">
            <div v-if="loading">
                <p class="text-center">Yüklənir</p>
            </div>
            <div class="postList">
                <div
                    class="d-flex justify-content-center"
                    v-for="(listing, i) in postData"
                    :key="i"
                >
                    <v-skeleton-loader
                        :loading="loading"
                        type="card"
                        min-width="14.5rem"
                        max-width="14.5rem"
                    >
                        <Post
                            :id="listing.id"
                            :image="
                                listing.id >= 500 ? `http://127.0.0.1:8000/storage/post-images/${listing.id}` : 'https://picsum.photos/id/' + Math.floor(listing.id/7) + '/1920/1080'
                            "
                            :user="listing.user"
                            :agency="listing.agency_id"
                            :type="listing.estate_type"
                            :city="listing.city"
                            :area="listing.area"
                            :roomCount="listing.room_count"
                            :address="listing.address"
                            :district="listing.district"
                            :apartmentFloor="listing.apartment_floor"
                            :totalFloors="listing.total_floors"
                            :price="listing.price"
                            :tradeType="listing.trade_type"
                            :isVip="listing.is_vip"
                            :hasVoucher="listing.has_voucher"
                            :realtorType="listing.realtor_type"
                            :createdAt="listing.created_at"
                            :loading="loading"
                        />
                    </v-skeleton-loader>
                </div>
            </div>
        </div>

        <div v-if="!postData.length && !loading">
            <div class="p-3 text-center" style="background-color: #E5E5E5; color: #595959; border-radius: 10px;">
                <p style="font-size: 1.2rem;">Heç bir elan yadda saxlanılmayıb</p>
            </div>
            <div class="text-center">
                <small>Elanı yadda saxlamaq üçün istənilən elanın
                    sağ-üst hissəsində olan,
                    <v-icon
                        small
                    >
                        mdi-bookmark
                    </v-icon>
                    işarəsini klikləyin
                </small>
            </div>
        </div>

    </div>
</template>

<script>
import { mapState } from "vuex";
import Post from "../components/Post.vue";
export default {
    components: { Post },
    data() {
        return {
            postData: {},
            loading: true,
        }
    },
    computed: {
        ...mapState(["savedPosts"]),

        // livePostData() {
        //     return this.postData
        // }
    },
    methods: {
        handlePosts() {
            this.loading = true
            axios
                .post("api/posts/custom", this.savedPosts)
                .then((res) => {
                    // console.log(res);
                    this.postData = res.data;
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    this.loading = false
                })
        },
    },
    mounted() {
        this.handlePosts();
    },
    watch: {
        savedPosts() {
            this.handlePosts()
        }
    }
};
</script>

<style></style>
