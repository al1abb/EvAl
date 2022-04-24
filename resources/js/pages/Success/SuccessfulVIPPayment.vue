<template>
  <div class="container">
      <h4>Successful purchase</h4>

      <p>You will be redirected back in {{ timerLabel }}</p>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            timer: 5000,
            timerLabel: 5,
        }
    },
    methods: {
        makeVip(id) {
            // start decreasing timer
            this.decreaseTimer()

            // get user token
            const token = localStorage.getItem("sanctum_token")

            console.log(token, "\n", this.$route.query.token)

            // check if current token is same as query token
            if(token === this.$route.query.token) {

                // update post to make vip
                axios.patch(`/api/post/${id}/make-vip`, { is_vip: true }, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                })
            }
            else {
                alert("Authentication Token does not match")
            }
        },
        decreaseTimer() {
            if(this.timerLabel > 0) {
                setTimeout(() => {
                    this.timerLabel -= 1
                    this.decreaseTimer()
                }, 1000)
            }
        }
    },
    mounted() {
        this.makeVip(this.$route.params.id)

        console.log("OLD URL")
        console.log(this.$route)

        setTimeout(() => {
            this.$router.push(`/post/${this.$route.params.id}`)
        }, this.timer)
    },
}
</script>

<style>

</style>