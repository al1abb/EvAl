<template>
    <div class="d-flex justify-content-around flex-wrap py-7 px-5"
        style="background-color: #E5E5E5; gap: 10px;"
    >
        <div class="selectItem">
            <v-select
                label="Ticarət növü"
                :items="tradeTypes"
                v-model="tradeType" 
                solo
                flat
                hide-details
                menu-props="bottom, offsetY"
            >

            </v-select>
        </div>
        
        <div class="selectItem">
            <v-select
                label="Əmlak növü"
                :items="propertyTypes"
                v-model="estateType"
                solo
                flat
                hide-details
                menu-props="bottom, offsetY"
            >

            </v-select>
        </div>
        
        <div class="selectItem">
            <v-select
                :items="roomCount"
                label="Otaq sayı"
                multiple
                solo
                flat
                hide-details
                menu-props="bottom, offsetY"
            >

            </v-select>
        </div>

        <div class="selectItem">
            <v-select
                :items="city"
                label="Şəhər"
                solo
                flat
                hide-details
                menu-props="bottom, offsetY"
            >
            </v-select>
        </div>

        <div>
            <v-menu
                :close-on-content-click="false"
                offset-y
                menu-props="bottom, offsetY"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        class="no-uppercase"
                        color="white"
                        v-bind="attrs"
                        v-on="on"
                        depressed
                        large
                        min-width="10rem"
                        min-height="3rem"
                    >
                        Qiymət
                    </v-btn>
                </template>

                <v-card class="d-flex justify-content-center align-items-center flex-row py-3 px-3">
                    <v-text-field
                        label="min"
                        style="max-width: 5rem;"
                        outlined
                        dense
                        flat 
                        :hide-details="true"
                        class="text-center mr-5"
                        autofocus 
                    >
                    </v-text-field>
                    
                    <v-text-field
                        label="max"
                        style="max-width: 5rem;"
                        outlined
                        dense
                        flat 
                        :hide-details="true"
                        class="text-center"
                    >
                    </v-text-field>
                </v-card>
            

            </v-menu>
        </div>

        <div>
            <v-btn
                class="no-uppercase"
                depressed
                outlined
                color="primary" 
                large
                min-width="10rem"
                min-height="3rem"
            >
                <v-icon>
                    mdi-magnify
                </v-icon> 
                
                <span class="ml-1">
                    Axtar
                </span>
            </v-btn>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            tradeType: 'Alış',
            tradeTypes: ['Alış', 'Kirayə'],

            estateType: 'Mənzil',
            propertyTypes: ['Mənzil', 'Ev-Villa', 'Ofis', 'Qaraj', 'Torpaq'],
            
            roomCount: ['1', '2', '3', '4', '5+'],
            city: ['Fərq etməz', 'Bakı', 'Sumqayıt', 'Gəncə'],
        }
    },
}
</script>

<style>
.selectItem {
    max-width: 10rem;
}
</style>