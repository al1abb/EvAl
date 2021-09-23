<template>
    <div>Hello World</div>

    <router-link to="/">Home</router-link>
    <router-link to="/test">Test</router-link>

    <router-view v-slot="{ Component }">
        <component :is="Component" />
    </router-view>
</template>

<script>
export default {

}
</script>

<style>

</style>