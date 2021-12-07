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
    // data() {
    //     return {
    //         response
    //     }
    // },
    // mounted() {
    //     let token = localStorage.getItem('sanctum_token');
    //     axios.get('/api/users', {
    //         headers: {
    //             'Authorization': 'Bearer '+token
    //         }
    //     })
    //     .then((response) => {
    //         console.log(response)
    //         this.response = response.data
    //     })
    //     .catch((err) => {
    //         console.log(err)
    //     })
    // }
}
</script>

<style scoped>
.formBox {
    display: flex;
    flex-direction: column;
}
</style>