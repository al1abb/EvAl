<template>
    <div class="d-flex justify-content-center">
        <div class="signInContainer py-5 px-5 mx-2">
            <p class="signIn_mainLabel mb-4">Şəxsi hesaba daxil ol</p>

            <v-form
                @submit.prevent="handleSignIn"
            >
                <!-- csrf -->
                <input type="hidden" name="_token" :value="csrf" />

                <v-text-field
                    v-model="formData.email"
                    label="E-mail"
                    append-icon="mdi-email"
                    outlined
                >
                </v-text-field>
                <v-text-field
                    v-model="formData.password"
                    label="Şifrə"
                    append-icon="mdi-lock"
                    outlined
                >
                </v-text-field>

                <v-btn
                    type="submit"
                    color="success"
                    class="shadow no-uppercase"
                    depressed
                >
                    Daxil ol
                </v-btn>
            </v-form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        handleSignIn() {
            axios.get('/sanctum/csrf-cookie')
            .then((response) => {
                // console.log(response)

                axios.post('/api/login', this.formData)
                .then((response) => {
                    console.log(response)

                    this.redirectToHome()
                })
                .catch((err) => {
                    console.log(err)
                })
            })
        },
        redirectToHome() {
            this.$router.push({ name: 'home' })
        }
    },
    computed: {
        csrf() {
            return document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
        },
    }
}
</script>

<style>
.signInContainer {
    background-color: #dadada;
    border-radius: 8px;

    width: 35rem;
}

.signIn_mainLabel {
    font-size: 1.2rem;
}

fieldset {
    background-color: white;
}
</style>