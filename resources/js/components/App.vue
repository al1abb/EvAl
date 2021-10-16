<template>
    <v-app
        class="appMain"
    >
        <v-container>
            <v-row
                class="text-center"
            >
                <v-col>
                    <p><router-link to="/">Home</router-link></p>
                </v-col>
                <v-col>
                    <p><router-link to="/test">Test</router-link></p>
                </v-col>
            </v-row>
            <v-btn
                elevation="2"
            >
                Hello
            </v-btn>
        </v-container>

        <router-view v-slot="{ Component }">
            <component :is="Component" />
        </router-view>
    </v-app>
</template>

<script>
export default {
    
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap');


p {
    margin: 0px !important;
    padding: 0px !important;
}

.appMain {
    background-color: #f7f2f2 !important;

    font-family: 'Noto Sans', sans-serif;
}
</style>