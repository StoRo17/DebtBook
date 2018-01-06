<template>
    <div class="collection">
        <debt v-for="debt in debts"
            :key="debt.id"
            :debt="debt">
        </debt>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Debt from './Debt.vue';

export default {
    components: {
        Debt
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