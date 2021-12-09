<template>
    <div>
        
        <pre>
            {{ formData }}
        </pre>
        
        <v-form
            @submit.prevent="addPost"
        >
            <div class="">
                <!-- POST OWNER -->
                <fieldset class="contactDiv">
                    <legend>Əlaqə</legend>

                    <div class="d-flex align-items-center">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Əlaqədar şəxs
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.realtor_name"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="text"
                        >
                        </v-text-field>
                    </div>

                    <div class="realtorType">
                        <v-radio-group v-model="formData.realtor_type">
                            <v-radio
                                :label="'Özümə aid elan'"
                                value="self"
                            ></v-radio>
                            <v-radio
                                :label="'Vasitəçi (agent) kimi'"
                                value="agent"
                            ></v-radio>
                        </v-radio-group>
                    </div>

                    <!--  CONTACT PHONE -->
                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Əlaqə nömrəsi
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.contact_phone_number"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="number"
                        >
                        </v-text-field>
                    </div>

                    <!-- CONTACT EMAIL -->
                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                E-mail
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.contact_email"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
                        >
                        </v-text-field>
                    </div>
                </fieldset>
            </div>

            <div class="mt-5">
                <fieldset class="contactDiv elevation-3" style="border: 1px solid #E1E1E1;">
                    <legend style="width: auto;">Elan</legend>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Əmlak növü
                            </p>
                        </div>

                        <v-select
                            class="formInput__textField"
                            type="text"
                            label="Əmlak növü"
                            :items="estateTypes"
                            v-model="formData.estate_type"
                            solo
                            dense
                            flat
                            hide-details
                            menu-props="bottom, offsetY"
                            clearable
                        >
                        </v-select>
                        
                    </div>

                    <!--  Sell type -->
                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Satış növü
                            </p>
                        </div>

                        <v-select
                            class="formInput__textField"
                            type="text"
                            label="Ticarət növü"
                            :items="tradeTypes"
                            v-model="formData.trade_type" 
                            solo
                            dense
                            flat
                            hide-details
                            menu-props="bottom, offsetY"
                            clearable
                            open-on-clear
                        >

                        </v-select>
                    </div>

                    <!-- CİTY -->
                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Şəhər
                            </p>
                        </div>

                        <v-select
                            class="formInput__textField"
                            type="text"
                            :items="cities"
                            v-model="formData.city"
                            label="Şəhər"
                            solo
                            flat
                            hide-details
                            menu-props="bottom, offsetY"
                            clearable
                        >
                        </v-select>
                    </div>

                    <!-- ROOM COUNT -->
                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Otaq sayı
                            </p>
                        </div>
                        <v-text-field
                            label="Otaq sayı"
                            v-model="formData.room_count"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="number"
                        >
                        </v-text-field>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Sahə
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.area"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="number"
                        >
                        </v-text-field>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Mərtəbə
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.apartment_floor"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="number"
                        >
                        </v-text-field>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Toplam mərt.
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.total_floors"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="number"
                        >
                        </v-text-field>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Əlavə məlumat
                            </p>
                        </div>
                        <v-textarea
                            v-model="formData.description"
                            solo
                            flat
                            hide-details
                            no-resize  
                            dense
                            class="formInput__textField"
                            type="text"
                        >
                        </v-textarea>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Qiymət
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.price"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="number"
                        >
                        </v-text-field>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Ünvan
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.address"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="text"
                        >
                        </v-text-field>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Rayon
                            </p>
                        </div>
                        <v-text-field
                            v-model="formData.district"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="text"
                        >
                        </v-text-field>
                    </div>
                </fieldset>
            </div>

            <v-btn
                color="green"
                class="no-uppercase my-5"
                style="color: #F1F1F1;"
                type="submit"
                :loading="loading"
            >
                Yüklə
            </v-btn>

        </v-form>

    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            formData: {
                realtor_name: '',
                contact_email: '',
                contact_phone_number: '',

                estate_type: '',

                city: '',
                area: '',
                area_unit: 'room',
                room_count: '',
                address: '',
                district: '',

                apartment_floor: '',
                total_floors: '',
                description: '',
                price: '',

                trade_type: '',
                realtor_type: '',
            },

            // selects
            estateTypes: ['Yeni Mənzil', 'Mənzil', 'Ev-Villa', 'Ofis', 'Qaraj', 'Torpaq'],

            tradeTypes: ['Satış', 'Kirayə'],

            cities: ['Bakı', 'Sumqayıt', 'Gəncə'],

            addResponseData: {}
        }
    },
    methods: {
        addPost() {
            this.loading = true

            let tradeType = ''

            if(this.formData.trade_type == 'Satış') {
                tradeType = 'sell'
            }
            else {
                tradeType = 'rent'
            }

            let estateType = ''

            if(this.formData.estate_type == 'Yeni Mənzil') {
                estateType = 'new_apartment'
            }
            else if(this.formData.estate_type == 'Mənzil') {
                estateType = 'apartment'
            }
            else if(this.formData.estate_type == 'Ev-Villa') {
                estateType = 'house_villa'
            }
            else if(this.formData.estate_type == 'Ofis') {
                estateType = 'office'
            }
            else if (this.formData.estate_type == 'Qaraj') {
                estateType = 'garage'
            }
            else if (this.formData.estate_type == 'Torpaq') {
                estateType = 'land'
            }
            else {
                estateType = 'undef'
            }

            this.formData.trade_type = tradeType
            this.formData.estate_type = estateType

            let token = localStorage.getItem('sanctum_token');
            axios.post('/api/posts', this.formData, {
                headers: {
                    'Authorization': 'Bearer '+token
                }
            })
            .then((response) => {
                console.log(response)
                this.addResponseData = response.data
            })
            .catch((err) => {
                console.log(err);
            })
            .finally(() => {
                this.loading = false

                this.redirectToPostPage(this.addResponseData.id)
            })
        },

        redirectToPostPage(id) {
            this.$router.push(`/post/${id}`)
        }
    },
}
</script>

<style scoped>
.contactDiv {
    background-color: #E5E5E5;
    border-radius: 5px;

    padding: 10px 30px;
}

.formInput__titleDiv {
    max-width: 8rem; 
    min-width: 8rem;
}

.formInput__title {
    font-weight: 600;
    font-size: 1rem;
}

.formInput__textField {
    max-width: 15rem;
    min-width: 10rem;
}

.realtorType > .v-input--radio-group {
    margin-top: 0px;
}
</style>