<template>
        <div class="container-sm d-flex flex-wrap justify-content-between align-items-center mt-5">
            <div class="my-3 w-100">
                <div class="mb-3 d-flex flex-row" >
                    <!-- Qiymət/Price -->
                    <p class="postpage__price">{{ price }} AZN</p>

                    <div class="d-flex flex-row text-center ml-auto">
                        <div class="px-2">

                            <!-- Yadda saxla/Save post -->
                            <div>
                                <v-btn
                                    icon
                                    :color="isPostSaved ? '#77A43D' : 'black'"
                                    @click="handleSave"
                                    :title="isPostSaved ? 'Yaddaşdan sil' : 'Yadda saxla'"
                                >
                                    <v-icon
                                        size="20"
                                        :style="isPostSaved ? '#77A43D' : '#FFFFFF'"
                                    >
                                        {{ isPostSaved ? 'mdi-bookmark' : 'mdi-bookmark-outline' }}
                                    </v-icon>
                                </v-btn>
                            </div>

                        </div>

                        <div class="px-2">
                           
                            <!-- Şikayət et/Report -->
                            <div>
                                <v-btn
                                    color="black"
                                    icon
                                    title="Şikayət et"
                                >
                                    <v-icon
                                        size="20"
                                    >
                                        mdi-flag-outline
                                    </v-icon>
                                </v-btn>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Short Description (price, area, room count) -->
                <div>
                    {{ estate }} {{ tradeOperation }}: {{ roomCount }} otaqlı, {{ area }} m², {{ apartmentFloor }}/{{ totalFloors }} mərtəbə, {{ district }} Rayonu
                </div>
            </div>
            
        </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
export default {
    props: ["id", "price", "estate", "tradeOperation", "roomCount", "area", "district", "apartmentFloor", "totalFloors"],
    methods: {
        ...mapActions(["savePost", "unsavePost"]),

        handleSave() {
            if(this.isPostSaved == false) {
                this.savePost(this.id)
            }
            else {
                this.unsavePost(this.id)
            }
        }
    },
    computed: {
        ...mapState(["savedPosts"]),
        
        isPostSaved() {
            return this.savedPosts.includes(this.id)
        },
    }
}
</script>

<style>

</style>