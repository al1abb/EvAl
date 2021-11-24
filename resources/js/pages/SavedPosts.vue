<template>
    <div class="container-sm">
        SavedPosts list: {{ savedPosts }}
    </div>
</template>

<script>
import { mapState } from 'vuex';
import Post from "../components/Post.vue";
export default {
    components: { Post },
    computed: {
        ...mapState(["savedPosts"]),
    }
};
</script>

<style></style>
