<template>
    <div class="container-sm">
        New post page:

        <p class="my-5" style="font-size: 1.5rem;">Add a new post:</p>

        <!-- <p>
            {{ response }}
        </p> -->

        <v-form style="max-width: 40rem; min-width: 20rem;">

            <v-text-field
                label="Estate type"
                v-model="estateType" 
            >
            </v-text-field>

            <v-text-field
                label="City"
                v-model="city"
            >
            </v-text-field>

            <v-text-field
                label="Area"
                v-model="area"
            >
            </v-text-field>

            <v-text-field
                label="Room Count"
                v-model="roomCount"
            >
            </v-text-field>

            <v-text-field
                label="Address"
                v-model="address"
            >
            </v-text-field>

            <v-text-field
                label="District"
                v-model="district"
            >
            </v-text-field>

            <v-text-field
                label="Apartment floor"
                v-model="apartmentFloor"
            >
            </v-text-field>

            <v-text-field
                label="Total floors"
                v-model="totalFloors"
            >
            </v-text-field>

            <v-text-area
                label="Description"
                v-model="description"
            >
            </v-text-area>

            <v-text-field
                label="Price"
                v-model="price"
            >
            </v-text-field>

            <v-text-field
                label="Contact email"
                v-model="contactEmail"
            >
            </v-text-field>

            <v-text-field
                label="Contact Phone"
                v-model="contactPhone"
            >
            </v-text-field>

            <v-text-field
                label="Trade type"
                v-model="tradeType"
            >
            </v-text-field>

            <v-text-field
                label="Realtor type"
                v-model="realtorType"
            >
            </v-text-field>

            <v-text-field
                label="VIP"
                v-model="isVip"
            >
            </v-text-field>

            <v-text-field
                label="Voucher"
                v-model="hasVoucher"
            >
            </v-text-field>

        </v-form>
    </div>
</template>

<script>
export default {
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

<style>

</style>