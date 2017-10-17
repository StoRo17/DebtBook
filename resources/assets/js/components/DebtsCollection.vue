<template>
    <div class="collection">
        <debt v-for="debt in debts"
              :key="debt.name"
              :name="debt.name"
              :amount="debt.amount"
              :currency="debt.currency">
        </debt>
    </div>
</template>

<script>
    import Debt from './Debt.vue';

    export default {
        components: {
            'debt': Debt
        },

        data () {
            return {
                debts: [
                    {
                        'name': 'Никита',
                        'amount': '100',
                        'currency': '₽'
                    },
                    {
                        'name': 'Андрей',
                        'amount': '200',
                        'currency': '$'
                    }
                ]
            }
        }

    }
</script>