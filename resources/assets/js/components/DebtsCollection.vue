<template>
    <div class="collection">
        <debt v-for="debt in debts"
            :key="debt.id"
            :debt="debt">
        </debt>
    </div>
</template>

<script>
import api from '../api/debtbook';
import Debt from './Debt.vue';

export default {
    components: {
        'debt': Debt
    },

    computed: {
        debts() {
            return this.$store.getters.debts;
        }
    },

    mounted() {
        api.getDebts(this.$store.getters.user.id)
            .then(response => {
                this.$store.dispatch('setDebts', response.data);
            })
            .catch(error => {
                console.log(error);
            })
    }
}
</script>