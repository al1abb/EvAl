<template>
    <div class="container-sm">
        <v-card class="responsiveImage">
            <Swiper class="swiper" :options="swiperOption">
                <SwiperSlide v-for="(item, i) in 9" :key="i">
                    <v-img
                        :src="
                            'https://picsum.photos/id/' +
                            Math.floor(id / 7+i) +
                            '/1920/1080'"
                    >
                    </v-img>
                </SwiperSlide>
                <div class="swiper-pagination" slot="pagination"></div>
                <!-- <div class="swiper-button-prev text-white" slot="button-prev"></div>
                <div class="swiper-button-next text-white" slot="button-next"></div> -->
            </Swiper>
        </v-card>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
import "swiper/css/swiper.css";
export default {
    props: ["id"],
    components: { Swiper, SwiperSlide },
    data() {
        return {
            swiperOption: {
                spaceBetween: 50,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                // effect: 'cube',
                // grabCursor: true,
                // cubeEffect: {
                //     shadow: true,
                //     slideShadows: true,
                //     shadowOffset: 20,
                //     shadowScale: 0.94
                // },

                // effect: 'coverflow',
                // grabCursor: true,
                // coverflowEffect: {
                //     rotate: 50,
                //     stretch: 0,
                //     depth: 100,
                //     modifier: 1,
                //     slideShadows : true
                // },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            },
        }
    }
}
</script>

<style>
.responsiveImage {
    max-width: 100%;
    height: auto;
}
</style>