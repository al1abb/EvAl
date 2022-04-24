<template>
    <div>
        
        <pre>
            {{ formData }}
        </pre>

        <!-- <pre>
            {{ image ? image : '' }}
        </pre> -->
        
        <v-form
            @submit.prevent="addPost"
            enctype="multipart/form-data"
        >
            <div class="">
                <!-- POST OWNER -->
                <fieldset class="contactDiv elevation-1" style="border: 1px solid rgb(89, 89, 89);">
                    <legend class="px-2" style="width: auto;">Əlaqə</legend>

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
                                class="radioBtn"
                            ></v-radio>
                            <v-radio
                                :label="'Vasitəçi (agent) kimi'"
                                value="agent"
                                class="radioBtn"
                                :disabled="!hasAgency"
                            ></v-radio>
                            <small v-if="!hasAgency" style="color: red;">*Agent kimi elan paylaşmaq üçün hər hansısa şirkətə bağlı olmalısınız</small>
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
                <fieldset class="contactDiv elevation-1" style="border: 1px solid rgb(89, 89, 89);">
                    <legend class="px-2" style="width: auto;">Elan</legend>

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
                            dense
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

                    <div class="my-5">
                        <div class="">
                            <p class="formInput__title">
                                Xəritədə ünvanı seçin:
                            </p>
                            
                        </div>

                        <small class="text-muted">Göstərdiyiniz ünvan doğru olduğuna əmin olun!</small>

                        <div>
                            <GmapMap
                                :center="{
                                    lat: 40.409264,
                                    lng: 49.867092
                                }"
                                :zoom="12"
                                map-type-id="terrain"
                                style="width: 500px; height: 300px"
                                @click="handleMapClick"
                            >
                                <GmapMarker
                                    :position="marker.position"
                                    :clickable="true"
                                    :draggable="true"
                                />
                            </GmapMap>
                        </div>
                    </div>
                    
                    <div class="">

                        <div class="formInput__titleDiv">
                            <p class="formInput__title">
                                Şəkillər
                            </p>
                        </div>

                        <!-- <input @change="fileInputOnChange" type="file" name="images" accept="image/png, image/jpeg" multiple> -->

                        <file-pond
                            class="filepond"
                            name="image"
                            ref="pond"
                            label-idle="Şəkli seçmək üçün klikləyin və ya şəkli bura atın..."
                            @init="filepondInitialized"
                            accepted-file-types="image/jpg, image/jpeg, image/png"
                            :allowReorder="true"
                            @processfile="handleProcessedFile"
                            max-file-size="1MB"

                            :storeAsFile="true"
                            :allowImagePreview="true"
                            :allowMultiple="true"

                            @onUpdateFiles="handleFilePondUpdateFile"
                            :instant-upload="true"
                        />
                    </div>
                </fieldset>
            </div>

            <v-btn
                color="green"
                class="no-uppercase my-5"
                style="color: #F1F1F1;"
                type="submit"
                depressed 
                :loading="loading"
            >
                Yüklə
            </v-btn>

            <!-- {{ image.name ? image.name : 'null' }} -->

        </v-form>

    </div>
</template>

<script>
import vueFilepond, { setOptions } from "vue-filepond";
import { mapState } from 'vuex';

// Plugins
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Styles
import "filepond/dist/filepond.min.css";
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

// Gets rid of warning in console
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";



// setOptions({
//     server: {
//         process: {
//             url: './upload',
//             onerror: (response) => {
//                 serverMessage = JSON.parse(response);
//             },
//             headers: {
//                 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf_token"]').content()
//             }
//         }
//     },
//     labelFileProcessingError: () => {
//         return serverMessage.error;
//     }
// });

const FilePond = vueFilepond(FilePondPluginImagePreview, FilePondPluginFileValidateType, FilePondPluginFileValidateSize);

export default {
    components: { FilePond },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            loading: false,
            formData: {
                realtor_name: '',
                contact_email: '',
                contact_phone_number: '',

                estate_type: '',

                latitude: 0,
                longitude: 0,

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

                image: [],
            },


            // selects
            estateTypes: ['Yeni Mənzil', 'Mənzil', 'Ev-Villa', 'Ofis', 'Qaraj', 'Torpaq'],

            tradeTypes: ['Satış', 'Kirayə'],

            cities: ['Bakı', 'Sumqayıt', 'Gəncə'],

            addResponseData: {},

            successfulPost: false,

            // hasAgency: false,

            // Map
            marker: {
                position: {
                    lat: 0,
                    lng: 0,
                }
            }
        }
    },
    methods: {
        filepondInitialized() {
            console.log("Filepond is ready");
            console.log('OBJECT: ', this.$refs.pond);
        },
        handleProcessedFile(error, file) {
            if(error) {
                console.log(error);
                return;
            }

            this.formData.image = file.serverId

            // add the file to our images array. unshift pushes to beginning instead of end
            // this.images.unshift(file.serverId);
        },
        // Set Images to Array
        handleFilePondUpdateFile(files){
            this.formData.image = files.map(files => files.file);
        },
        // Map click
        handleMapClick(event) {
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();

            this.marker.position.lat = lat;
            this.marker.position.lng = lng;

            this.formData.latitude = lat;
            this.formData.longitude = lng;
        },
        addPost() {
            this.loading = true

            let formD = new FormData()
            formD.append('realtor_name', this.formData.realtor_name)
            formD.append('contact_email', this.formData.contact_email)
            formD.append('contact_phone_number', this.formData.contact_phone_number)
            formD.append('estate_type', this.formData.estate_type)
            formD.append('latitude', this.formData.latitude)
            formD.append('longitude', this.formData.longitude)
            formD.append('city', this.formData.city)
            formD.append('area', this.formData.area)
            formD.append('area_unit', this.formData.area_unit)
            formD.append('room_count', this.formData.room_count)
            formD.append('address', this.formData.address)
            formD.append('district', this.formData.district)
            formD.append('apartment_floor', this.formData.apartment_floor)
            formD.append('total_floors', this.formData.total_floors)
            formD.append('description', this.formData.description)
            formD.append('price', this.formData.price)
            formD.append('trade_type', this.formData.trade_type)
            formD.append('realtor_type', this.formData.realtor_type)
            formD.append('image', this.formData.image)

            // let formMerged = {...this.formData, ...formD}

            let token = localStorage.getItem('sanctum_token');

            axios.post('/api/posts', this.formData, {
                headers: {
                    'Authorization': 'Bearer '+token,
                }
            })
            .then((response) => {
                console.log("aaaa")
                console.log(response)
                // this.addResponseData = response.data
                this.successfulPost = true
                this.redirectToPostPage(response.data.id)
            })
            .catch((err) => {
                console.log(err);
                this.successfulPost = false
            })
            .finally(() => {
                this.loading = false
            })
        },

        redirectToPostPage(id) {
            this.$router.push(`/post/${id}`)
        },

        // fileInputOnChange(e) {
        //     this.image = e.target.files[0]
        //     // this.formData.images = e.target.files[0]
        //     console.log(e.target.files[0])
        // }
    },
    computed: {
        ...mapState(["user"]),

        // agencyCheck() {
        //     // this.hasAgency = false;

        //     console.log("AG ID");
        //     console.log(this.agencyId);

        //     if(this.agencyId != null) {
        //         this.hasAgency = true;
        //     }
        //     else {
        //         this.hasAgency = false;
        //     }
        // },

        hasAgency() {
            if(this.user.agency_id != null) {
                return true;
            }
            else {
                return false;
            }
        },
    },
    mounted() {
        // ! Removed: check agency. Using computed property instead
        // this.agencyCheck()

        // handle filepond file upload
        let serverMessage = {};
        // let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let token = localStorage.getItem("sanctum_token");

        setOptions({
            server: {
                process: {
                    url: '/api/upload',
                    onerror: (response) => {
                        serverMessage = JSON.parse(response);
                    },
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token,
                        'X-CSRF-TOKEN': this.csrf
                    }
                },
                labelFileProcessingError: () => {
                    return serverMessage.error;
                }
            }
        })
    }
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

.radioBtn /deep/ label {
    color: rgb(89, 89, 89);
    font-weight: 500;
    font-size: 0.9rem;

    margin-bottom: 0px;
}
</style>