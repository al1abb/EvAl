<template>
    <div class="container-sm">
        <!-- This is agency page {{ $route.params.id }} -->

        <p style="font-size: 1.1rem; font-weight: 600;">
            Agentlik: {{ agencyData.agency_name }}
        </p>

        <p>
            Haqqında:
        </p>

        <p>
            {{ agencyData.agency_description }}
        </p>

        <div v-if="!loading && agencyData.posts.length" class="mt-10">
            <p class="text-center my-2" style="font-size: 1.2rem;">
                "{{ agencyData.agency_name }}" agentliyi əməkdaşları tərəfindən qoyulan elanlar:
            </p>
            <div class="postList">
                <div class="d-flex justify-content-center" v-for="(post, i) in agencyData.posts" :key="i">
                    <Post
                        :id="post.id"
                        :image="post.id >= 500 ? `http://127.0.0.1:8000/storage/post-images/${post.id}` : 'https://picsum.photos/id/' + Math.floor(post.id/7) + '/1920/1080'"
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

        <div v-if="!loading && !agencyData.posts.length">
            <div class="p-3 my-5 text-center" style="background-color: #E5E5E5; color: #595959; border-radius: 10px;">
                <p style="font-size: 1.2rem;">Agentlik əməkdaşlarının heç bir elanı yoxdur</p>
            </div>
        </div>

        <!-- <pre>
            {{ agencyData }}
        </pre> -->
    </div>
</template>

<script>
import Post from "../components/Post.vue"

export default {
    components: { Post },
    data() {
        return {
            agencyData: {},
            loading: false
        }
    },
    methods: {
        getAgencyData(id) {
            this.loading = true

            axios.get(`/api/agency/${id}`)
            .then((response) => {
                console.log(response)
                this.agencyData = response.data
            })
            .catch((err) => {
                console.log(err)
            })
            .finally(() => {
                this.loading = false
            })
        }
    },
    mounted() {
        this.getAgencyData(this.$route.params.id)
    }
}
</script>

<style>

</style>