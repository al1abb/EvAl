<template>
    <div
        class="container-sm d-flex flex-wrap justify-content-between align-items-center mt-5"
    >
        <div class="my-3 w-100">
            <p>
                <v-icon v-if="isVip" color="red" title="Elan VİP elandır">
                    mdi-crown
                </v-icon>
                <v-icon
                    v-if="isAgency && realtorType == 'agent'"
                    color="primary"
                >
                    mdi-domain
                </v-icon>
            </p>

            <div class="mb-3 d-flex flex-row">
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
                                :title="
                                    isPostSaved
                                        ? 'Yaddaşdan sil'
                                        : 'Yadda saxla'
                                "
                            >
                                <v-icon
                                    size="20"
                                    :style="isPostSaved ? '#77A43D' : '#FFFFFF'"
                                >
                                    {{
                                        isPostSaved
                                            ? "mdi-bookmark"
                                            : "mdi-bookmark-outline"
                                    }}
                                </v-icon>
                            </v-btn>
                        </div>
                    </div>

                    <div class="px-2">
                        <!-- Şikayət et/Report -->
                        <div>
                            
                            <v-menu
                                v-model="flagMenu"
                                :close-on-content-click="false"
                                :nudge-width="300"
                                offset-y
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn color="black" icon title="Şikayət et" v-bind="attrs" v-on="on">
                                        <v-icon size="20"> mdi-flag-outline </v-icon>
                                    </v-btn>
                                </template>

                                <v-card>

                                    <v-card-text>
                                        <form>
                                            <!-- <label style="font-size: 1rem; font-weight: 600; color: black;"></label> -->
                                            <v-textarea
                                                v-model="flagReason"
                                                outlined
                                                label="Şikayət səbəbi:"
                                            >

                                            </v-textarea>
                                        </form>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>

                                        <v-btn text @click="flagMenu = false">
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="handleFlagSubmission(id)"
                                            :loading="flagLoading"
                                        >
                                            Save
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-menu>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Short Description (price, area, room count) -->
            <div>
                <p>
                    {{ estate }} {{ tradeOperation }}: {{ roomCount }} otaqlı,
                    {{ area }} m², {{ apartmentFloor }}/{{
                        totalFloors
                    }}
                    mərtəbə, {{ district }} Rayonu
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
                            <v-icon> mdi-arrow-up-bold </v-icon>
                            <p style="font-weight: 600">Elanı irəli çək</p>
                        </v-btn>
                    </template>

                    <div class="bg-white container">
                        <v-card-title>
                            Elanı irəli çəkmək üçün aşağıdakı xidmətlərdən
                            birini seçin
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
                                    Ödəniş
                                </v-stepper-step>
                            </v-stepper-header>
                            <v-stepper-items>
                                <v-stepper-content step="1">
                                    <!-- Stepper 1. Choose service -->
                                    <div
                                        class="d-flex justify-content-around align-items-center"
                                    >
                                        <v-radio-group
                                            v-model="radioGroup"
                                            style="
                                                display: flex !important;
                                                align-items: center !important;
                                            "
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
                                            <h4 style="font-weight: 600">
                                                {{ SRRadioPrice }}
                                            </h4>
                                        </div>
                                    </div>
                                </v-stepper-content>

                                <!-- Stepper 2. Stripe Checkout -->
                                <v-stepper-content step="2">
                                    <div
                                        class="d-flex justify-content-around align-items-center"
                                    >
                                        <v-btn
                                            class="no-uppercase"
                                            depressed
                                            @click="submitStripePayment"
                                        >
                                            Ödəniş et
                                        </v-btn>
                                    </div>
                                </v-stepper-content>

                                <!-- Stepper 3.  -->
                                <v-stepper-content step="3">
                                    <div
                                        class="d-flex justify-content-around align-items-center"
                                    >
                                        Success
                                    </div>
                                </v-stepper-content>
                            </v-stepper-items>

                            <div
                                class="d-flex justify-content-around align-items-center py-3"
                            >
                                <v-btn
                                    class="no-uppercase"
                                    outlined
                                    color="red"
                                    @click="stepperBack"
                                    :disabled="stepper == 1 ? true : false"
                                >
                                    Geri
                                </v-btn>

                                <v-btn
                                    class="no-uppercase"
                                    outlined
                                    color="blue"
                                    @click="stepperForward"
                                    :disabled="stepper == 3 ? true : false"
                                >
                                    İrəli
                                </v-btn>
                            </div>
                        </v-stepper>
                    </div>
                </v-dialog>

                <v-btn
                    class="no-uppercase"
                    outlined
                    color="red"
                    @click="makePostVIP"
                >
                    <v-icon> mdi-diamond-stone </v-icon>
                    <p style="font-weight: 600">Elanı VİP et</p>
                </v-btn>
            </div>

            <div></div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
// import { StripeCheckout } from "@vue-stripe/vue-stripe";
import { loadStripe } from "@stripe/stripe-js";

const localAuthToken = localStorage.getItem("sanctum_token");

export default {
    props: [
        "id",
        "price",
        "estate",
        "tradeOperation",
        "roomCount",
        "area",
        "district",
        "apartmentFloor",
        "totalFloors",
        "isVip",
        "isAgency",
        "realtorType",
    ],
    data() {
        return {
            flagMenu: false,
            flagReason: "",
            flagLoading: false,

            publishableKey: process.env.MIX_STRIPE_PK,

            SRImprovementDialog: false,
            makeVipDialog: false,

            stepper: 1,
            radioGroup: 1,
            radioMessages: [
                "empty element because of v-for",
                "1",
                "5",
                "10",
                "20",
            ],

            scoreProducts: [
                {
                    empty: "Empty object",
                },

                {
                    price: "price_1Kmu69FTyLubqrgiBmJLPBYD",
                    quantity: 1,
                },
                {
                    price: "price_1Kmu6rFTyLubqrgi8NJrRkO0",
                    quantity: 1,
                },
                {
                    price: "price_1Kmu7TFTyLubqrgiS5OWr7Vf",
                    quantity: 1,
                },
                {
                    price: "price_1Kmu82FTyLubqrgi5J4fHIds",
                    quantity: 1,
                },
            ],

            checkoutOptions: {
                lineItems: [],
                mode: "payment",
                successUrl: `${window.location.origin}/post/${this.id}/successful-score-payment/1?token=${localAuthToken}`,
                cancelUrl: `${window.location.origin}/post/${this.id}`,
            },

            checkoutOptionsVip: {
                lineItems: [
                    {
                        price: "price_1KoVDAFTyLubqrgiJnAJPKaX",
                        quantity: 1,
                    },
                ],
                mode: "payment",
                successUrl: `${window.location.origin}/post/${this.id}/make-vip?token=${localAuthToken}`,
                cancelUrl: `${window.location.origin}/post/${this.id}`,
            },
        };
    },
    methods: {
        ...mapActions(["savePost", "unsavePost"]),

        handleSave() {
            if (this.isPostSaved == false) {
                this.savePost(this.id);
            } else {
                this.unsavePost(this.id);
            }
        },
        stepperBack() {
            if (this.stepper > 1) {
                this.stepper--;
            }
        },
        stepperForward() {
            if (this.stepper != 3) {
                this.stepper++;
            }
        },
        getStripe() {
            const stripePromise = loadStripe(process.env.MIX_STRIPE_PK);
            return stripePromise;
        },
        async submitStripePayment() {
            // this.$refs.checkoutRef.redirectToCheckout();
            const stripe = await this.getStripe();
            const { error } = await stripe.redirectToCheckout(
                this.checkoutOptions
            );

            if (error) {
                console.log("Stripe checkout error: ", error);
            }
        },
        async makePostVIP() {
            const stripe = await this.getStripe();
            const { error } = await stripe.redirectToCheckout(
                this.checkoutOptionsVip
            );

            if (error) {
                console.log("Stripe checkout error: ", error);
            }
        },

        handleFlagSubmission(postId) {
            this.flagLoading = true

            axios.post(`/api/flags`, {
                flag_reason: this.flagReason,
                post_id: postId
            }, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem("sanctum_token")
                }
            })
            .then((res) => {
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            })
            .finally(() => {
                this.flagLoading = false
                this.flagMenu = false
                this.flagReason = ""
            })
        }
    },
    computed: {
        ...mapState(["savedPosts"]),

        isPostSaved() {
            return this.savedPosts.includes(this.id);
        },

        isPostVip() {
            return this.isVip;
        },

        SRRadioPrice() {
            // 1 dene
            if (this.radioGroup == 1) {
                return "1,00 AZN";
            }
            // 5 dene
            if (this.radioGroup == 2) {
                return "4,00 AZN";
            }
            // 10 dene
            if (this.radioGroup == 3) {
                return "7,00 AZN";
            }
            // 20 dene
            if (this.radioGroup == 4) {
                return "12,00 AZN";
            }
        },

        SRRadioPriceFormatted() {
            // 1 dene
            if (this.radioGroup == 1) {
                return "1";
            }
            // 5 dene
            if (this.radioGroup == 2) {
                return "4";
            }
            // 10 dene
            if (this.radioGroup == 3) {
                return "7";
            }
            // 20 dene
            if (this.radioGroup == 4) {
                return "12";
            }
        },
    },
    mounted() {
        this.checkoutOptions.lineItems = [this.scoreProducts[1]];
    },
    watch: {
        radioGroup() {
            this.checkoutOptions.lineItems = [
                this.scoreProducts[this.radioGroup],
            ];
            this.checkoutOptions.successUrl = `${window.location.origin}/post/${this.id}/successful-score-payment/${this.radioGroup}?token=${localAuthToken}`;
            console.log(this.checkoutOptions.lineItems);
        },
    },
};
</script>

<style>
.v-radio > .v-label {
    margin: 0px;
}
</style>
