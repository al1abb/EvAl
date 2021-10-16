<template>
    <router-link 
        style="text-decoration: none; color: inherit;" 
        :to="{ name: 'postPage', params: { id } }"
        class=""
    >
        <v-card
            class="postMain"
            min-width="16rem"
            max-width="16rem"
            @click="$router.push('test')"
            :elevation="elevation"
            @mouseover="elevation=1"
            @mouseleave="elevation=0"
            style="border-radius: 7px;"
        >
            
            <!-- max-height="32rem"
            min-height="32rem" -->
            <v-img
                class="white--text align-end"
                height="11rem"
                src="https://picsum.photos/300"
            >
                <!-- <template v-slot:placeholder>
                    <v-skeleton-loader
                        :loading="true"
                        class="mx-auto"
                        type="card"
                        style=""
                    ></v-skeleton-loader>
                </template> -->

            </v-img>

            <v-card-title
                style=""
                class="postPrice"
            >{{ formattedPrice }} ₼ (AZN)</v-card-title>

            <div class="d-flex flex-column">
                <div style="">
                    <v-card-subtitle class="p-0 pl-3 pb-2">
                        <!-- <v-chip
                            color="primary"
                            class="mb-2"
                            small
                        >
                            {{ type }}
                        </v-chip> -->
                    
                        <p class="districtName">{{ district }}</p>
                        <p class="postStats">
                            <span v-if="roomCount">{{ roomCount }} rooms</span>
                            <span>•</span>
                            <span v-if="area">{{ area }} m²</span>
                        </p>
                        <p class="cityName">
                            {{ cityAndTime }}
                        </p>
                    </v-card-subtitle>
                    <!-- <div>
                        by {{ user.name }}
                    </div> -->
                </div>
                
                <!-- <div style="">
                    <v-card-actions>
                        <v-btn
                            color="orange"
                            text
                        >
                            See more
                        </v-btn>
                    </v-card-actions>
                </div> -->
            </div>
        </v-card>
    </router-link>

    
</template>

<script>
export default {
    props: ["id", "user", "city", "district", "type", "area", "roomCount", "description", "price", "createdAt", "loading"],
    data() {
        return {
            elevation: 0,
            raised: false,
        }
    },
    computed: {
        // desc: function() {
        //     if(this.description.length > 100) {
        //         return this.description.slice(0, 100) + "...";
        //     }
        // },
        formattedPrice: function() {
            return this.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },
        cityAndTime: function() {
            return `${this.city}, ${this.createdAt.slice(8, 10)}-${this.createdAt.slice(5,7)}-${this.createdAt.slice(0, 4)}`
        }
    }
}
</script>

<style>
.postMain {
}

.postMain:hover {
    cursor: pointer;
    background-color: aqua;
}

.postPrice {
    /* border-radius: 7px !important; */

    font-size: 1.15rem !important;
    font-weight: bold !important;

    padding-top: 0px !important;
    padding-bottom: 0px !important;
    margin-top: 8px !important;
}

.districtName {
    font-size: 0.95rem;
}

.postStats {
    font-size: 0.85rem;
}

.cityName {
    font-size: 0.81rem;
    color: #969595;
}
</style>