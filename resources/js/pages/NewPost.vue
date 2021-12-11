<template>
    <div class="container-sm" style="max-width: 40rem;">
        

        <!-- <p class="my-5" style="font-size: 1.5rem;">Add a new post:</p> -->

        <!-- <p>
            {{ response }}
        </p> -->

        <v-form class="" style="">

            <div class="formBox">
                <NewPostForm />
            </div>

        </v-form>
    </div>
</template>

<script>
import NewPostForm from '../components/forms/NewPostForm.vue'
export default {
    components: { NewPostForm },
}
</script>

<style scoped>
.formBox {
    display: flex;
    flex-direction: column;
}
</style>