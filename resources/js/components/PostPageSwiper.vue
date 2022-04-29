<template>
    <div class="container-sm" style="max-width: 60rem;">
        <v-card class="responsiveImage">
            <Swiper class="swiper" v-if="postMedia.length" :options="swiperOption">
                <SwiperSlide v-for="(item, i) in postMedia.length" :key="i">
                    <v-img
                        :src="postMedia[i].title"
                        :aspect-ratio="16/9"
                        contain
                    >
                        <template v-slot:placeholder>
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-black"></div>
                        </template>
                    </v-img>
                </SwiperSlide>
                <div class="swiper-pagination" slot="pagination"></div>
                <div class="swiper-button-prev text-white" slot="button-prev"></div>
                <div class="swiper-button-next text-white" slot="button-next"></div>
            </Swiper>

            <Swiper class="swiper" v-if="!postMedia.length" :options="swiperOption">
                <SwiperSlide v-for="(item, i) in 1" :key="i">
                    <!-- 'https://picsum.photos/id/' +
                                Math.floor(id / 7+i) +
                                '/1920/1080' -->
                    <v-img
                        :src="imageUrl"
                        :aspect-ratio="16/9"
                        contain
                    >
                        <template v-slot:placeholder>
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-black"></div>
                        </template>
                    </v-img>
                </SwiperSlide>

                <div class="swiper-pagination" slot="pagination"></div>
                <div class="swiper-button-prev text-white" slot="button-prev"></div>
                <div class="swiper-button-next text-white" slot="button-next"></div>
            </Swiper>

            <!-- Swiper for Dummy Data testing -->
            <!-- <Swiper class="swiper" v-if="id<=500" :options="swiperOption">
                <SwiperSlide v-for="(item, i) in 9" :key="i">
                    'https://picsum.photos/id/' +
                                Math.floor(id / 7+i) +
                                '/1920/1080'
                    <v-img
                        :src="'https://picsum.photos/id/' +
                                Math.floor(id / 7+i) +
                                '/1920/1080'"
                        :aspect-ratio="16/9"
                        contain
                    >
                        <template v-slot:placeholder>
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-black"></div>
                        </template>
                    </v-img>
                </SwiperSlide>

                <div class="swiper-pagination" slot="pagination"></div>
                <div class="swiper-button-prev text-white" slot="button-prev"></div>
                <div class="swiper-button-next text-white" slot="button-next"></div>
            </Swiper> -->


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
            imageSrc: '',
            postMedia: {},

            swiperOption: {
                lazy: true,
                centeredSlides: true,
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
                    prevEl: '.swiper-button-prev',
                }
            },
        }
    },
    methods: {
        // getPostImages(id) {
        //     axios.get(`/api/post/${id}/images`)
        //     .then((response) => {
        //         console.log(response)
        //         this.postImageResponse = response.data
        //     })
        //     .catch((err) => {
        //         console.log(err)
        //     })
        // }
        
        // get post media from PostMediaController
        getPostMedia(postId) {
            axios.get(`/api/post/${postId}/media`)
                .then((res) => {
                    this.postMedia = JSON.parse(JSON.stringify(res.data));
                    console.log(this.postMedia)
                })
                .catch((err) => {
                    console.log(err);
                })
        }
    },
    mounted() {
        this.getPostMedia(this.$route.params.id);
    },
    computed: {
        imageUrl() {
            return `https://picsum.photos/id/${this.id}/200/300`;
        }
    }
}
</script>

<style>
.responsiveImage {
    max-width: 100%;
    height: auto;
}

.swiper-button-next::after {
    
}
</style>

<style scoped>
/* .v-image__image {
    background-size: 100% 100%;
} */
</style>