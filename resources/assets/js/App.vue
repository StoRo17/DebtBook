<template>
    <div id="app">
        <template v-if="loaded">
            <header-nav></header-nav>
            <main>
                <router-view></router-view>
            </main>
        </template>
        <template v-else>
            <spinner size="massive"></spinner>
        </template>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Spinner from 'vue-simple-spinner';
import api from './api/debtbook';
import HeaderNav from './components/Header.vue';

export default {
    data() {
        return {
            loaded: false
        }
    },

    components: {
        HeaderNav,
        Spinner
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

                    api.getProfile(this.userId)
                        .then(response => {
                            this.$store.dispatch('setProfile', response.data);
                            this.loaded = true;
                        })
                        .catch(error => {
                            console.log(error);
                        })
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>
