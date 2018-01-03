<template>
    <router-link 
        :to="{ name: 'debtHistory', params: { id: debt.id }}"
        class="collection-item waves-effect">{{ debt.name }}
        <div class="right">{{ getCurrencyById(debt.currency_id) }}&nbsp;{{ debt.total_amount }}
            <i class="material-icons right">keyboard_arrow_right</i>
        </div>
    </router-link>
</template>

<script>
export default {
    props: ['debt'],

    computed: {
        currencies() {
            return this.$store.getters.currencies;
        }
    },

    methods: {
        getCurrencyById(currency_id) {
            for (let currency of this.currencies) {
                if (currency.id == currency_id) {
                    return currency.currency;
                }
            }
        }
    }
}
</script>