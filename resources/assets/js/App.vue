<template>
    <div id="app">
        <template v-if="!loading">
            <header-nav></header-nav>
            <main>
                <div class="container">
                    <router-view></router-view>
                </div>
            </main>
        </template>
        <template v-else-if="error">
            <h2>{{ 'main.error' | trans }}</h2>
        </template>
        <template v-else>
            <spinner size="massive"></spinner>
        </template>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Spinner from 'vue-simple-spinner';
import HeaderNav from './components/Header.vue';

export default {
    components: {
        HeaderNav,
        Spinner
    },

    computed: {
        ...mapGetters([
            'loading',
            'error',
            'isLoggedIn',
            'userId'
        ])
    },

    created() {
        if (this.isLoggedIn) {
            this.$store.dispatch('loadUser', this.userId);
            this.$store.dispatch('loadProfile', this.userId);
        }
    }
}
</script>
