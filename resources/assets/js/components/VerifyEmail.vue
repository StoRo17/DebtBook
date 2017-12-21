<template>
    <div class="container">
        <template v-show="loaded">
            <div class="row">
                <h5 class="center-align">{{ message }}</h5>
                <template v-if="success">
                    <div class="center-align">
                        <router-link class="waves-light btn-large"
                                    :to="{name: 'login'}">{{ 'auth.sign_in' | trans }}
                        </router-link>
                    </div>
                </template>
            </div>
        </template>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            message: '',
            success: false,
            loaded: false
        }
    },
    created() {
        axios.get('/api/verify-email/' + this.$route.params.email_token)
        .then(response => {
            console.log(response.data);
            this.message = 'Your email was successfully verified. Click button below to login';
            this.success = true;
            this.loaded = true;
        })
        .catch(error => {
            this.message = 'Error';
        });
    }
}
</script>
