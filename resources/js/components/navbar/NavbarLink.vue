<template>
    <router-link
        :to="to"
        class="no-uppercase reset_word_spacing text-light p-2"
    >
       <v-icon :color="icon=='mdi-bookmark' ? '#4caf50' : '#FFFFFF'">{{ icon }}</v-icon> {{ text }}
    </router-link>
</template>

<script>
export default {
    props: ["to", "text", "icon"],
}
</script>

<style>

</style>