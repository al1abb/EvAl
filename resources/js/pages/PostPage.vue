<template>
    <div>
        <!-- {{ post }} -->
        <div v-if="loading">LOADING</div>
        <!-- <div class="d-flex justify-content-center" v-show="!loading"> -->
            <!-- <p>id: {{ post.id }}</p>
            <p>type: {{ post.estate_type }}</p>
            <p>city: {{ post.city }}</p>
            <p>area: {{ post.area }}</p>
            <p>description: {{ post.description }}</p>
            <p>price: {{ post.price }}</p>
            <p>address: {{ post.address }}</p>
            <p>district: {{ post.district }}</p>
            <p>viewsToday: {{ post.views_today }}</p>
            <p>viewsTotal: {{ post.views_total }}</p>
            <p>roomCount: {{ post.room_count }}</p>
            <p>apartmentFloor: {{ post.apartment_floor }}</p>
            <p>tradeType: {{ post.trade_type }}</p>
            <pre>POST: {{ post }}</pre> -->

            
        <!-- </div> -->

        <div v-if="!loading">

            <div class="d-flex justify-content-center">
                <PostPageSwiper :id="post.id"/>
            </div>

            <PostPageTop
                :id="post.id"
                :price="formattedPrice"
                :estate="estate"
                :tradeOperation="tradeOperation"
                :roomCount="post.room_count"
                :area="post.area"
                :district="post.district"
                :apartmentFloor="post.apartment_floor"
                :totalFloors="post.total_floors"
                :isVip="post.is_vip"
                :isAgency="post.agency_id"
                :realtorType="post.realtor_type"
            />
            
            <PostPageMid 
                :description="description"
                :user="post.user"
                :phoneNumber="post.contact_phone_number"
                :realtorType="post.realtor_type"
            />

            <!-- Google Map Location for the post -->
            <div class="container-sm">
                <div class="py-5" style="">
                    <h5 style="font-weight: 600;">Xəritədə ünvan:</h5>
                    <div>
                        <GmapMap
                            :center="mapPosition"
                            :zoom="16"
                            map-type-id="terrain"
                            style="height: 300px;"
                            class="post-map"
                        >
                            <GmapMarker
                                :position="mapPosition"
                                :clickable="true"
                                :draggable="true"
                            />
                        </GmapMap>
                    </div>
                </div>
            </div>

            <div class="container-sm py-4">
                <p style="font-weight: 600;">Baxışlar: </p>
                <div class="d-flex">
                    <p class="">Bugün: {{ post.views_today }}</p>
                    <p class="px-2">Ümumi: {{ post.views_total }}</p>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
import PostPageSwiper from '../components/PostPageSwiper.vue';
import PostPageTop from '../components/postpage/PostPageTop.vue';
import PostPageMid from '../components/postpage/PostPageMid.vue';
import { mapState } from 'vuex';
export default {
    components: { PostPageSwiper, PostPageTop, PostPageMid },
    data() {
        return {
            post: {},

            ownPost: null,

            loading: false,
        };
    },
    mounted() {
        this.fetchData();
        this.checkIfOwnPost();
    },
    methods: {
        fetchData() {
            this.loading = true;
            const fetchId = this.$route.params.id;

            axios
                .get("/api/post/" + fetchId)
                .then((response) => {
                    this.post = response.data;
                    // console.log(this.post);
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        checkIfOwnPost() {
            console.log(this.user, this.post.user)
            if(this.user == this.post.user) {
                console.log("MY POST");
            }
            else {
                console.log("NOT MY POST");
            }
        }
    },
    computed: {
        ...mapState(["user"]),

        formattedPrice() {
            return this.post.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
        },
        estate() {
            const estateType = this.post.estate_type
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
        tradeOperation() {
            const tradeType = this.post.trade_type
            if(tradeType == 'sell') {
                return 'Satılır'
            }
            else if(tradeType == 'rent') {
                return 'Kirayə'
            }
            else {
                return 'Undefined'
            }
        },
        description() {
            const desc = this.post.description
            
            return desc
        },
        computedLat() {
            return parseFloat(this.post.latitude)
        },
        computedLng() {
            return parseFloat(this.post.longitude)
        },
        mapPosition() {
            return {
                lat: this.computedLat,
                lng: this.computedLng
            }
        }
    }
};
</script>

<style>
.postpage__price {
    font-size: 1.5rem;
    font-weight: bold;
}

.post-map > .vue-map {
    border: 3px solid white;
    border-radius: 15px;
}
</style>
