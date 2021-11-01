<template>
    <div
        class="d-flex justify-content-around flex-wrap py-3"
        style="background-color: #264454;"
    >
        <div>
            <p class="brandName">
                <router-link to="/" style="">EvAl</router-link>
            </p>
        </div>

        <div class="d-flex justify-content-center">
            <NavbarLink 
                to="/" 
                text="Ana səhifə"
            />

            <NavbarLink 
                to="/all" 
                text="Bütün elanlar"
            />

            <NavbarLink 
                to="/kiraye-evler" 
                text="Kiraye"
            />
        </div>

        <div class="d-flex justify-content-end">
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

        <div>
            <v-btn
                color="green"
                class="no-uppercase reset_word_spacing text-light"
                rounded
                depressed
            >
                Yeni elan

                <v-icon right>
                    mdi-plus
                </v-icon>
            </v-btn>

        </div>
    </div>
</template>

<script>
import NavbarLink from "./NavbarLink.vue";
export default {
    components: { NavbarLink }
};
</script>

<style></style>
