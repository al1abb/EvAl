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

        }
    },
    computed: {
        showSearch() {
            if(this.$route.name == 'signin' || this.$route.name == 'signup') {
                // do not show navbar bottom
                return false
            }
            else {
                // show
                return true
            }
        }
    }
}
</script>

<style>

</style>