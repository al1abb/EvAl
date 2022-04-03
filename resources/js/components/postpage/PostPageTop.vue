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
                    <p>
                        {{ estate }} {{ tradeOperation }}: {{ roomCount }} otaqlı, {{ area }} m², {{ apartmentFloor }}/{{ totalFloors }} mərtəbə, {{ district }} Rayonu
                    </p>
                </div>

                <!-- Improve search ranking buttons -->
                <div class="my-2">
                    <v-dialog
                        v-model="SRImprovementDialog"
                        min-width="30rem"
                        max-width="50rem"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                class="no-uppercase"
                                outlined
                                color="blue"
                                v-bind="attrs"
                                v-on="on"
                            >
                                <v-icon>
                                    mdi-arrow-up-bold
                                </v-icon>
                                <p style="font-weight: 600;">Elanı irəli çək</p>
                            </v-btn>
                        </template>

                        <div class="bg-white">
                            <v-card-title>
                                Elanı irəli çəkmək üçün aşağıdakı xidmətlərdən birini seçin
                            </v-card-title>

                            <v-stepper v-model="stepper">
                                <v-stepper-header>
                                    <v-stepper-step
                                        :complete="stepper > 1"
                                        step="1"
                                    >
                                        Xidmət seçin
                                    </v-stepper-step>
                                    <v-divider></v-divider>
                                    <v-stepper-step
                                        :complete="stepper > 2"
                                        step="2"
                                    >
                                        Ödəniş edin
                                    </v-stepper-step>
                                    <v-divider></v-divider>
                                    <v-stepper-step
                                        step="3"
                                    >
                                        Step 3
                                    </v-stepper-step>
                                </v-stepper-header>
                                <v-stepper-items>
                                    <v-stepper-content
                                        step="1"
                                    >
                                        <!-- Stepper 1 -->
                                        <div class="d-flex justify-content-around align-items-center">
                                            <v-radio-group
                                                v-model="radioGroup"
                                                style="display: flex !important; align-items: center !important;"
                                            >
                                                <v-radio
                                                    v-for="i in 4"
                                                    :key="i"
                                                    :label="`${radioMessages[i]} xal irəli çək`"
                                                    :value="i"
                                                >
                                                </v-radio>
                                            </v-radio-group>
                                            <div>
                                                <h5 style="">Xidmət haqqı:</h5> 
                                                <h4 style="font-weight: 600;">{{ SRRadioPrice }}</h4>
                                            </div>
                                        </div>
                                        
                                        
                                    </v-stepper-content>

                                    <v-stepper-content
                                        step="2"
                                    >
                                        <div class="d-flex justify-content-around align-items-center">
                                            Stripe checkout
                                        </div>
                                        
                                    </v-stepper-content>

                                    <v-stepper-content
                                        step="3"
                                    >
                                        <div class="d-flex justify-content-around align-items-center">
                                            Success
                                        </div>
                                    </v-stepper-content>
                                </v-stepper-items>

                                <div class="d-flex justify-content-around align-items-center py-3">
                                    <v-btn
                                        class="no-uppercase"
                                        outlined
                                        color="red"
                                        @click="stepperBack"
                                        :disabled="stepper==1 ? true : false"
                                    >
                                        Geri
                                    </v-btn>

                                    <v-btn
                                        class="no-uppercase"
                                        outlined
                                        color="blue"
                                        @click="stepperForward"
                                        :disabled="stepper==3 ? true : false"
                                    >
                                        İrəli
                                    </v-btn>
                                </div>
                            </v-stepper>
                        </div>
                    </v-dialog>

                    <v-dialog
                        v-model="makeVipDialog"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                class="no-uppercase"
                                outlined
                                color="red"
                                v-bind="attrs"
                                v-on="on"
                            >
                                <v-icon>
                                    mdi-diamond-stone
                                </v-icon>
                                <p style="font-weight: 600;">Elanı VİP et</p>
                            </v-btn>
                        </template>
                    </v-dialog>
                </div>

                <div>

                </div>
            </div>
            
        </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
export default {
    props: ["id", "price", "estate", "tradeOperation", "roomCount", "area", "district", "apartmentFloor", "totalFloors"],
    data() {
        return {
            SRImprovementDialog: false,
            makeVipDialog: false,

            stepper: 1,
            radioGroup: 1,
            radioMessages: [
                "empty element because of v-for",
                "1",
                "5",
                "10",
                "20"
            ]
        }
    },
    methods: {
        ...mapActions(["savePost", "unsavePost"]),

        handleSave() {
            if(this.isPostSaved == false) {
                this.savePost(this.id)
            }
            else {
                this.unsavePost(this.id)
            }
        },

        handleSRImprovement() {
            console.log(this.radioGroup)


        },
        stepperBack() {
            if(this.stepper > 1) {
                this.stepper--;
            }
        },
        stepperForward() {
            if(this.stepper != 3) {
                this.stepper++;
            }
        }
    },
    computed: {
        ...mapState(["savedPosts"]),
        
        isPostSaved() {
            return this.savedPosts.includes(this.id)
        },

        SRRadioPrice() {
            // 1 dene
            if(this.radioGroup == 1) {
                return "1,00 AZN"
            }
            // 5 dene
            if(this.radioGroup == 2) {
                return "4,00 AZN"
            }
            // 10 dene
            if(this.radioGroup == 3) {
                return "7,00 AZN"
            }
            // 20 dene
            if(this.radioGroup == 4) {
                return "12,00 AZN"
            }
        }
    }
}
</script>

<style>
    .v-radio > .v-label {
        margin: 0px;
    }
</style>