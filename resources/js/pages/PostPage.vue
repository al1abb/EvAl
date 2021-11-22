<template>
    <div>
        <!-- {{ post }} -->
        <div v-if="loading">LOADING</div>
        <div class="d-flex justify-content-center" v-show="!loading">
            <!-- <p>id: {{ post.id }}</p>
            <p>type: {{ post.estate_type }}</p>
            <p>city: {{ post.city }}</p>
            <p>area: {{ post.area }}</p>
            <p>description: {{ post.description }}</p>
            <p>price: {{ post.price }}</p>
            <p>address: {{ post.address }}</p>
            <p>district: {{ post.district }}</p>
            <p>viewsToday: {{ post.views_today }}</p>
            <p>viewsTotal: {{ post.views_total }}</p>
            <p>roomCount: {{ post.room_count }}</p>
            <p>apartmentFloor: {{ post.apartment_floor }}</p>
            <p>tradeType: {{ post.trade_type }}</p>
            <pre>user: {{ post.user }}</pre>
            
            <pre>POST: {{ post }}</pre> -->
            <!-- <v-card min-width="20rem" max-width="25rem">
                <v-img
                    :src="
                        'https://picsum.photos/id/' +
                        Math.floor(post.id / 7) +
                        '/1920/1080'"
                >
                </v-img>
            </v-card> -->

            
        </div>

        <PostPageSwiper :id="post.id" />

        <div class="container-sm">
            <p>{{ post.estate_type }}</p>
        </div>

    </div>
</template>

<script>
import PostPageSwiper from '../components/PostPageSwiper.vue';
export default {
    components: { PostPageSwiper },
    data() {
        return {
            post: {},
            loading: false,
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            const fetchId = this.$route.params.id;

            axios
                .get("/api/post/" + fetchId)
                .then((response) => {
                    this.post = response.data;
                    console.log(this.post);
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style>
/* .responsiveImage {
  max-width: 100%;
  height: auto;
} */
</style>
