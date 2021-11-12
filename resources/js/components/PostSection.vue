<template>
    <section>
        <div class="d-flex flex-column justify-content-center align-items-center">

            <div
                class="d-flex justify-content-center align-items-center mb-4" 
                style="background-color: white; height: 5rem; width: 60%; text-align: center; border-radius: 5px;"
            >
                <span v-if="!loading" class="section-header">{{ title }}</span>

                <v-skeleton-loader
                    v-if="loading"
                    height="100%"
                    width="100%"
                    type="heading"
                    class="section-header-loader"
                >

                </v-skeleton-loader>
                
            </div>

            <div style="width: 60%;">
                <div class="postList">

                    <div class="d-flex justify-content-center" v-for="(listing, i) in responseData" :key="i">
                        <v-skeleton-loader
                            :loading="loading"
                            type="card"
                            min-width="14.5rem"
                            max-width="14.5rem"
                        >
                            <Post 
                                :id="listing.id"
                                :image="'https://picsum.photos/id/' + Math.ceil(listing.id/100) + '/1920/1080'"
                                :user="listing.user"
                                :agency="listing.agency"
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
                                
                                :createdAt="listing.created_at"
                                :loading="loading"
                            />
                        </v-skeleton-loader>
                    </div>

                </div>
            </div>

        </div>

    </section>

</template>

<script>
import Post from '../components/Post.vue';

export default {
    components: { Post },
    props: ["title", "responseData", "loading"],
    data() {
        return {
            
        }
    },
}
</script>

<style>
.postList {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(14.5rem, max-content));
    grid-gap: 16px;
    justify-content: center;
    gap: 1rem;
}
.section-header {
    font-size: 1.0rem;
    font-weight: 600;
}
.section-header-loader .v-skeleton-loader__heading {
    width: 100%;
    height: 100%;
    border-radius: unset;
}
</style>