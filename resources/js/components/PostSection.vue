<template>
    <section class="container-sm" style="width: 100%;">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div
                class="d-flex justify-content-center align-items-center mb-4" 
                style="background-color: white; height: 5rem; width: 100%; text-align: center; border-radius: 5px;"
            >
                <span v-if="!loading" class="section-header">
                    <v-icon
                        :color="isVip ? 'red' : (isAgency) ? '#0053c0' : ''"
                        size="25"
                    >
                        {{ isVip ? 'mdi-crown' : (isAgency ? 'mdi-domain' : '') }}
                    </v-icon>
                    <span style="vertical-align: sub;">{{ title }}</span>
                </span>

                <v-skeleton-loader
                    v-if="loading"
                    height="100%"
                    width="100%"
                    type="heading"
                    class="section-header-loader"
                >

                </v-skeleton-loader>
                
            </div>

            <div style="width: 100%;">
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
                                :image="listing.id >= 500 ? `http://127.0.0.1:8000/storage/post-images/${listing.id}` : 'https://picsum.photos/id/' + Math.floor(listing.id/7) + '/1920/1080'"
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

                    <div v-if="!responseData.length && !loading">
                        <div class="p-3 text-center" style="background-color: #E5E5E5; border-radius: 10px;">
                            <p style="font-size: 1.2rem; color: #595959;">{{ title }} tapılmadı</p>
                        </div>
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
    props: ["title", "responseData", "loading", "isVip", "isAgency"],
    data() {
        return {
            env: process.env.MIX_APP_ENV
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