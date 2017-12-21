<template>
    <div class="container">
        <div class="row" v-if="loaded">
            <h5 class="center-align">Your Email is successfully verified. Click button below to login</h5>
            <div class="center-align">
                <router-link class="waves-light btn-large"
                             :to="{name: 'login'}">{{ 'auth.sign_in' | trans }}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        loaded: false;
    },
    created() {
        axios.get('/api/verify-email/' + this.$route.params.email_token)
        .then(response => {
            console.log(response.data);
            this.loaded = true;
        })
        .catch(error => {
        });
    }
}
</script>
