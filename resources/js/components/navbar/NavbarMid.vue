<template>
    <div
        class="d-flex justify-content-around flex-wrap py-3"
        style="background-color: #19488A;"
    >
        <div class="d-flex justify-content-center align-items-center">
            <p class="brandName">
                <router-link to="/" style="">EvAl</router-link>
            </p>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <NavbarLink 
                to="/" 
                text="Ana səhifə"
            />

            <NavbarLink 
                to="/butun-elanlar" 
                text="Bütün elanlar"
            />

            <NavbarLink 
                to="/kiraye-evler" 
                text="Kiraye"
            />
        </div>

        <div class="d-flex justify-content-end align-items-center">
            <!-- <v-btn
                    class="no-uppercase reset_word_spacing"
                    color="white"
                    text
                >
                    <v-icon left>
                        mdi-bookmark
                    </v-icon>
                    İşarələnmişlər
                </v-btn> -->

            <NavbarLink
                to="/isarelenmisler"
                text="İşarələnmişlər"
                icon="mdi-bookmark"
            />
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <span class="mr-1 text-light">Yeni elan paylaş</span>
            <v-btn
                color="green"
                class="no-uppercase reset_word_spacing"
                style="color: white !important;"
                :ripple="false"
                fab
                to="/yeni-elan"
            >
                <v-icon>
                    mdi-plus
                </v-icon>
            </v-btn>

        </div>
    </div>
</template>

<script>
import NavbarLink from "./NavbarLink.vue";
export default {
    components: { NavbarLink },
    methods: {
    }
};
</script>

<style>
.mdi-bookmark::before {
    /* -webkit-text-fill-color: #00000050; */
    -webkit-text-stroke-width: 0px;
    -webkit-text-stroke-color: white;
}
</style>
