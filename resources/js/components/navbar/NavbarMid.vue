<template>
    <div
        class="primary-bg d-flex justify-content-around flex-wrap py-3"
    >
        <div class="d-flex justify-content-center align-items-center">
            <p class="brandName">
                <router-link to="/" style="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" style="overflow: visible;" viewBox="0 0 512 512" data-svgdocument="" id="_FWNRMBjIxs___LnuR333V" class="fl-svgdocument" x="0" y="0" overflow="hidden" data-bbox="-1.001836756457132e-13 25.749313601171252 512.0000000000001 460.5013727976575"><defs id="_TMeXM-8VXXnSietAKSu-Z" transform="matrix(0.8259854316711426, 0, 0, 0.8259854316711426, 47.999996185302734, 44.547725677490234)" data-uid="o_f0abkg94h_4"></defs><g id="_94C4bbQB8tEZaop8ygYfs" transform="matrix(3.4504234790802, 0, 0, 3.4504234790802, -0.00001563692421768792, -627.308349609375)" data-uid="o_f0abkg94h_5"><path id="_ldRmikpPRx-UwQTCs8yUo" d="M83.484,93h-67C13.723,93,12,90.923,12,88.161V70.318c0-1.341,0.281-2.626,1.237-3.566l33.621-33.168    c1.958-1.922,5.03-1.909,6.972,0.026l33.475,33.168C88.246,67.717,89,68.99,89,70.318v17.843C89,90.923,86.246,93,83.484,93z     M22,83h57V72.393L50.724,44.187L22,72.415V83z" fill="rgba(255,98,98,1)" transform="matrix(1.5367107391357422, 0, 0, 1.5367107391357422, -2.305354595184326, 179.81703186035156)" stroke="rgba(0, 0, 0, 0)" stroke-width="0" data-uid="o_f0abkg94h_6"></path><path id="_nARyeNY6FSK8I60irj81h" d="M93.28,56.984c-1.277,0-2.556-0.486-3.531-1.46L50.874,16.745c-0.325-0.324-0.861-0.327-1.192-0.001L10.224,55.521     c-1.97,1.935-5.135,1.907-7.071-0.062c-1.936-1.97-1.908-5.136,0.062-7.071l39.46-38.779c4.226-4.145,11.068-4.12,15.259,0.054     l38.878,38.782c1.955,1.95,1.959,5.116,0.009,7.071C95.844,56.494,94.562,56.984,93.28,56.984z" fill="#59bfff" transform="matrix(1.5367107391357422, 0, 0, 1.5367107391357422, -2.641686201095581, 179.2551727294922)" stroke="#000000" stroke-width="0" data-uid="o_f0abkg94h_7"></path></g></svg>
                </router-link>
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

            <!-- <NavbarLink 
                to="/vip-elanlar" 
                text="VİP elanlar"
            /> -->
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
                title="İşarələnmişlər"
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

            
            <!-- <NavbarLink
                to="/isarelenmisler"
                title="İşarələnmişlər"
                icon="mdi-bookmark"
            /> -->

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
.primary-bg {
background: rgb(3,74,166);
}

.mdi-bookmark::before {
    /* -webkit-text-fill-color: #00000050; */
    -webkit-text-stroke-width: 0px;
    -webkit-text-stroke-color: white;
}
</style>
