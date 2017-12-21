<template>
    <div id="app">
        <header-nav></header-nav>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import api from './api/debtbook';
import HeaderNav from './components/Header.vue';

export default {
    components: {
        HeaderNav
    },

    computed: {
        ...mapGetters([
            'isLoggedIn',
            'userId'
        ])
    },

    created() {
        if (this.isLoggedIn) {
            api.getUser(this.userId)
                .then(response => {
                    this.$store.dispatch('setUser', response.data);
                })
                .catch(error => {
                    console.log(error);
                })

            api.getProfile(this.userId)
                .then(response => {
                    this.$store.dispatch('setProfile', response.data);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>
