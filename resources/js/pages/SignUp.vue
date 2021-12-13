<template>
    <div class="d-flex justify-content-center">
        <div class="signUpContainer py-5 px-5 mx-2">
            <p class="signUp_mainLabel mb-4">Şəxsi hesabını yarat</p>

            <v-form
                v-model="formValid"
                lazy-validation
                @submit.prevent="submitRegister"
                ref="form"
            >
                <!-- csrf -->
                <!-- <input type="hidden" name="_token" :value="csrf" /> -->

                <v-text-field
                    v-model="formData.name"
                    required
                    label="Ad"
                    type="name"
                    :rules="nameRules"
                    prepend-icon="mdi-account"
                    solo
                    flat
                    :loading="loading"
                >
                </v-text-field>

                <v-text-field
                    v-model="formData.email"
                    required
                    label="E-mail"
                    type="email"
                    :rules="emailRules"
                    prepend-icon="mdi-email"
                    solo
                    flat
                    :loading="loading"
                >
                </v-text-field>

                <v-text-field
                    v-model="formData.password"
                    required
                    label="Şifrə"
                    :type="passwordVisible ? 'text' : 'password'"
                    :rules="passwordRules"
                    prepend-icon="mdi-lock"
                    solo
                    flat
                    :loading="loading"
                >
                    <template v-slot:append>
                        <v-icon @click="passwordVisible=!passwordVisible">{{ passwordVisible ? 'mdi-eye-off' : 'mdi-eye' }}</v-icon>
                    </template>
                </v-text-field>

                <v-text-field
                    v-model="formData.password_confirmation"
                    required
                    label="Şifrəni təsdiqlə"
                    :type="confirmPasswordVisible ? 'text' : 'password'"
                    :rules="passwordConfirmationRules"
                    prepend-icon="mdi-lock"
                    append-icon="mdi-eye"
                    solo
                    flat
                    :loading="loading"
                >
                    <template v-slot:append>
                        <v-icon @click="confirmPasswordVisible=!confirmPasswordVisible">{{ confirmPasswordVisible ? 'mdi-eye-off' : 'mdi-eye' }}</v-icon>
                    </template>
                </v-text-field>

                <v-btn
                    type="submit"
                    color="red lighten-1"
                    class="shadow no-uppercase text-light"
                    depressed
                    :loading="loading"
                    :disabled="!formValid"
                    @click="validateForm"
                >
                    Qeydiyyatdan keç
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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role: 'user'
            },
            formValid: true,
            loading: false,

            passwordVisible: false,
            confirmPasswordVisible: false,
            nameRules: [
                v => !!v || 'Ad tələb olunur',
                // v => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
            emailRules: [
                v => !!v || 'E-mail tələb olunur',
                v => /.+@.+\..+/.test(v) || 'E-mail adresi etibarlı deyil',
            ],
            passwordRules: [
                v => !!v || 'Şifrə tələb olunur',
                // (value) => (value && value.length >= 6) || 'minimum 6 characters',
            ],
            passwordConfirmationRules: [
                v => !!v || 'Şifrə təsdiqlənməsi tələb olunur',
                v => (v === this.formData.password) || 'Şifrələr uyğun gəlmir'
            ]
        }
    },
    methods: {
        ...mapActions([
            "register"
        ]),

        async submitRegister() {
            this.loading = true
            try {
                const response = await this.register(this.formData)
                this.$router.replace({ name: 'home' })
            } catch(err) {
                this.formData.name = '',
                this.formData.email = '',
                this.formData.password = '',
                this.formData.password_confirmation = ''
            }
            this.loading = false
        },

        validateForm() {
            this.$refs.form.validate()
        },
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
.signUpContainer {
    background-color: #dadada;
    border-radius: 8px;

    width: 35rem;
}

.signUp_mainLabel {
    font-size: 1.2rem;
}

fieldset {
    background-color: white;
}
</style>