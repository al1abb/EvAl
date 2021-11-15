<template>
    <div class="py-7 px-5"
        style="background-color: #E5E5E5;"
    >
        <v-form
            class="d-flex justify-content-around flex-wrap"
            style="gap: 10px;"
            @submit.prevent="submitSearch"
        >

            <div class="selectItem">
                <v-select
                    label="Ticarət növü"
                    :items="tradeTypes"
                    v-model="searchQuery.tradeType" 
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
                    :items="estateTypes"
                    v-model="searchQuery.estateType"
                    solo
                    flat
                    hide-details
                    menu-props="bottom, offsetY"
                >

                </v-select>
            </div>
            
            <div class="selectItem">
                <v-select
                    :items="roomCounts"
                    v-model="searchQuery.roomCount"
                    label="Otaq sayı"
                    solo
                    flat
                    hide-details
                    menu-props="bottom, offsetY"
                >

                </v-select>
            </div>

            <div class="selectItem">
                <v-select
                    :items="cities"
                    v-model="searchQuery.city"
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
                            v-model="searchQuery.priceMin"
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
                            v-model="searchQuery.priceMax"
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
                    color="primary" 
                    large
                    min-width="10rem"
                    min-height="3rem"
                    type="submit"
                    :loading="loading"
                    :disabled="loading"
                >
                    <v-icon>
                        mdi-magnify
                    </v-icon> 
                    
                    <span class="ml-1">
                        Axtar
                    </span>
                </v-btn>
            </div>

            <div style="position: absolute; top: 0px;">
                {{ searchQuery }}
            </div>

        </v-form>

    </div>
</template>

<script>
import { mapState } from 'vuex';
import { mapActions } from 'vuex';
export default {
    data() {
        return {
            loading: false,

            tradeTypes: ['Hamısı', 'Alış', 'Kirayə'],
            estateTypes: ['Hamısı', 'Yeni Mənzil', 'Mənzil', 'Ev-Villa', 'Ofis', 'Qaraj', 'Torpaq'],
            roomCounts: ['Hamısı', '1', '2', '3', '4', '5'],
            cities: ['Hamısı', 'Bakı', 'Sumqayıt', 'Gəncə'],

            searchQuery: {
                tradeType: 'Alış',
                estateType: 'Mənzil',
                roomCount: 'Hamısı',
                city: 'Hamısı',
                priceMin: '0',
                priceMax: '1000000'
            },

            searchResponse: {},
        }
    },
    computed: {
        ...mapState([
            "searchLoading",
            "searchQueryStore",
            "searchData"
        ])
    },
    methods: {
        ...mapActions([
            "search"
        ]),

        async submitSearch() {
            this.loading = true
            this.$store.commit('setSearchLoading', true)
            this.pushToSearch()
            const res = await this.search(this.searchQuery)
            
            this.$store.commit('setSearchQueryStore', this.searchQuery)

            console.log("Search Result (from NavbarBottom form submit):")
            console.log(res)
            this.$store.commit('setSearchData', res)

            this.loading = false
            this.$store.commit('setSearchLoading', false)
        },

        pushToSearch() {
            this.$router.push({ 
                name: 'search',
                // params: response.data,
                query: {
                    'tradeType': this.searchQuery.tradeType,
                    'estateType': this.searchQuery.estateType,
                    'roomCount': this.searchQuery.roomCount,
                    'city': this.searchQuery.city,
                    'priceMin': this.searchQuery.priceMin,
                    'priceMax': this.searchQuery.priceMax
                }
            }).catch(err => {})
        },

        checkQuery() {
            this.$store.commit('setSearchLoading', true)
            if(this.$route.name == 'search') {
                this.searchQuery.tradeType = this.$route.query.tradeType
                this.searchQuery.estateType = this.$route.query.estateType
                this.searchQuery.roomCount = this.$route.query.roomCount
                this.searchQuery.city = this.$route.query.city
                this.searchQuery.priceMin = this.$route.query.priceMin
                this.searchQuery.priceMax = this.$route.query.priceMax
                this.submitSearch()
            }
            this.$store.commit('setSearchLoading', false)
        }
    },
    mounted() {
        this.checkQuery()
    }
}
</script>

<style>
.selectItem {
    max-width: 10rem;
}
</style>