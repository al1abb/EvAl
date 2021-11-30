<template>
    <div class="">
        <div v-if="!loading && userPosts.length">
            <p class="text-center my-2" style="font-size: 1.2rem;">
                {{ userName }} tərəfindən qoyulan elanlar:
            </p>
            <div class="postList">
                <div class="d-flex justify-content-center" v-for="(post, i) in userPosts" :key="i">
                    <Post
                        :id="post.id"
                        :image="'https://picsum.photos/id/' + Math.floor(post.id/7) + '/1920/1080'"
                        :user="post.user"
                        :agency="post.agency_id"
                        :type="post.estate_type"
                        :city="post.city"
                        :area="post.area"
                        :roomCount="post.room_count"
                        :address="post.address"
                        :district="post.district"
                                        
                        :apartmentFloor="post.apartment_floor"
                        :totalFloors="post.total_floors"
                                        
                        :price="post.price"

                        :tradeType="post.trade_type"

                        :isVip="post.is_vip"
                        :hasVoucher="post.has_voucher"
                        :realtorType="post.realtor_type"
                                        
                        :createdAt="post.created_at"
                        :loading="loading"
                    />
                </div>
            </div>

        </div>

        <div v-if="!loading && !userPosts.length">
            <div class="p-3 text-center" style="background-color: #E5E5E5; color: #595959; border-radius: 10px;">
                <p style="font-size: 1.2rem;">İstifadəçinin heç bir elanı yoxdur</p>
            </div>
        </div>


    </div>
</template>

<script>
import { mapState } from 'vuex'

import Post from './Post.vue'
import PostSection from './PostSection.vue'
export default {
    props: ["userName"],
    components: { Post, PostSection },
    data() {
        return {
            userPosts: {},
            loading: true,
        }
    },
    methods: {
        getUserPosts(id) {
            this.loading = true
            axios.get(`/api/user/${id}/posts`)
            .then((response) => {
                console.log(response)
                this.userPosts = response.data
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loading = false
            })
        }
    },
    computed: {
        ...mapState(["user"])
    },
    mounted() {
        this.getUserPosts(this.$route.params.id)
    }
}
</script>

<style>

</style>