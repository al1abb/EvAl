<template>
    <div class="d-flex justify-content-center">
        <div class="signInContainer py-5 px-5 mx-2">
            <p class="signIn_mainLabel mb-4">Şəxsi hesaba daxil ol</p>

            <v-form
                v-model="formValid"
                lazy-validation 
                @submit.prevent="submit"
                ref="form"
            >
                <!-- csrf -->
                <!-- <input type="hidden" name="_token" :value="csrf" /> -->

                <v-text-field
                    v-model="formData.email"
                    label="E-mail"
                    :rules="emailRules"
                    prepend-icon="mdi-email"
                    flat
                    solo
                    :loading="loading"
                >
                </v-text-field>
                <v-text-field
                    v-model="formData.password"
                    label="Şifrə"
                    :type="passwordVisible ? 'text' : 'password'"
                    :rules="passwordRules"
                    prepend-icon="mdi-lock"
                    flat
                    solo
                    :loading="loading"
                >
                    <template v-slot:append>
                        <v-icon @click="passwordVisible=!passwordVisible">{{ passwordVisible ? 'mdi-eye-off' : 'mdi-eye' }}</v-icon>
                    </template>
                </v-text-field>

                <v-alert 
                    v-if="error"
                    type="error"
                    dismissible
                >
                    Yanlış parametrlər daxil olunub və ya hesab mövcud deyil. 
                    <router-link :to="{ path: '/qeydiyyat' }" class="text-warning">
                        Qeydiyyatdan keç
                    </router-link>
                </v-alert>

                <v-btn
                    type="submit"
                    color="success"
                    class="shadow no-uppercase"
                    depressed
                    :loading="loading"
                    :disabled="!formValid"
                    @click="validateForm"
                >
                    Daxil ol
                </v-btn>
            </v-form>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
            },
            formValid: true,
            loading: false,
            error: false,

            passwordVisible: false,

            emailRules: [
                v => !!v || 'E-mail tələb olunur',
                v => /.+@.+\..+/.test(v) || 'E-mail adresi etibarlı deyil',
            ],
            passwordRules: [
                v => !!v || 'Şifrə tələb olunur',
                // (value) => (value && value.length >= 6) || 'minimum 6 characters',
            ],

            timeout: null,
        }
    },
    methods: {
        ...mapActions([
            "signIn"
        ]),
        
        async submit() {
            this.loading = true
            try {
                const response = await this.signIn(this.formData)
                this.$router.replace({ name: 'home' })
            } catch(err) {
                clearTimeout(this.timeout)
                this.showError()
                this.formData.email = ''
                this.formData.password = ''
            }
            this.loading = false

        },

        validateForm() {
            this.$refs.form.validate()
        },

        showError() {
            clearTimeout(this.timeout)
            this.error = true

            this.timeout = setTimeout(() => {
                this.error = false
            }, 7000)
        }
        // handleSignIn() {
        //     axios.get('/sanctum/csrf-cookie')
        //     .then((response) => {
        //         // console.log(response)

        //         axios.post('/api/login', this.formData)
        //         .then((response) => {
        //             console.log(response)

        //             this.redirectToHome()
        //         })
        //         .catch((err) => {
        //             console.log(err)
        //         })
        //     })
        // },
        // redirectToHome() {
        //     this.$router.push({ name: 'home' })
        // }
    },
    computed: {
        // csrf() {
        //     return document
        //         .querySelector('meta[name="csrf-token"]')
        //         .getAttribute("content");
        // },
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