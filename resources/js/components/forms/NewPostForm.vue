<template>
    <div>
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
                            v-model="contactUser"
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
                        <v-radio-group v-model="radioGroup">
                            <v-radio
                                v-for="(n, i) in radioBtn"
                                :key="i"
                                :label="n" 
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
                            v-model="contactPhone"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="text"
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
                            v-model="contactEmail"
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
                        <v-text-field
                            v-model="estateType"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="text"
                        >
                        </v-text-field>
                    </div>

                    <!--  Sell type -->
                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Satış növü
                            </p>
                        </div>
                        <v-text-field
                            v-model="sellType"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="text"
                        >
                        </v-text-field>
                    </div>

                    <!-- CİTY -->
                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Şəhər
                            </p>
                        </div>
                        <v-text-field
                            v-model="city"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
                        >
                        </v-text-field>
                    </div>

                    <div class="d-flex align-items-center py-1">
                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Otaq sayı
                            </p>
                        </div>
                        <v-text-field
                            v-model="roomCount"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
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
                            v-model="area"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
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
                            v-model="apartmentFloor"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
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
                            v-model="totalFloors"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
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
                            v-model="description"
                            solo
                            flat
                            hide-details
                            no-resize  
                            dense
                            class="formInput__textField"
                            type="email"
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
                            v-model="price"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
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
                            v-model="address"
                            solo
                            flat
                            hide-details
                            dense
                            class="formInput__textField"
                            type="email"
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
                            v-model="district"
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

            <v-btn
                color="green"
                class="no-uppercase my-5"
                style="color: #F1F1F1;"
                type="submit"
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
            radioBtn: [
                "Özümə aid elan",
                "Vasitəçi (agent) kimi"
            ]
        }
    },
    methods: {
        addPost() {
            console.log("ADD POST HERE")
        }
    }
}
</script>

<style scoped>
.contactDiv {
    background-color: #E5E5E5;
    border-radius: 5px;

    padding: 10px 50px;
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
}

.realtorType > .v-input--radio-group {
    margin-top: 0px;
}
</style>