<template>
    <div>
        <template v-if="!this.$store.state.debts.loading">
            <div class="collection">
                <debt v-for="debt in debts"
                    :key="debt.id"
                    :debt="debt">
                </debt>
            </div>
        </template>
        <template v-else>
            <spinner size="big"></spinner>
        </template>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Spinner from 'vue-simple-spinner';
import Debt from './Debt.vue';

export default {
    components: {
        Debt,
        Spinner
    },

    computed: {
        ...mapGetters([
            'debts',
            'currencies',
            'isLoggedIn',
            'userId'
        ])
    },

    mounted() {
        if (this.isLoggedIn) {
            this.$store.dispatch('loadCurrencies', this.userId);
            this.$store.dispatch('loadDebts', this.userId);
        }
    }
}
</script>