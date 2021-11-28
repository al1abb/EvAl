<template>
    <div class="container-sm my-10" style="width: 100%;">
        <NavbarTop />
        <NavbarMid />
        <NavbarBottom v-if="showSearch" />
    </div>
</template>

<script>
import NavbarTop from './NavbarTop.vue';
import NavbarMid from './NavbarMid.vue';
import NavbarBottom from './NavbarBottom.vue';

export default {
    components: { NavbarTop, NavbarMid, NavbarBottom },
    data() {
        return {
            searchNotVisibleRoutes: ["signin", "signup", "userProfile"]
        }
    },
    computed: {
        showSearch() {
            // If blacklist array includes route name in array, 
            // then do not show navbar bottom,
            // otherwise show
            if(this.searchNotVisibleRoutes.indexOf(this.$route.name) > -1) { 
                return false
            }
            else {
                return true
            }
        }
    }
}
</script>

<style>

</style>