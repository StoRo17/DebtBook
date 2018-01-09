<template>
    <div>
        <div id="add-debt-btn" class="center">
        <a href="#" @click.prevent="deleteDebt" class="waves-effect waves-light btn green lighten-1">
            <i class="material-icons right">delete</i>{{ 'debts.delete_all' | trans }}
        </a>
        </div>
        <ul class="collection with-header">
            <li class="collection-header"><h4>{{ 'debts.debt_history' | trans }}</h4></li>
            <template v-if="!this.$store.state.debtHistory.loading">
                <li class="collection-item" v-for="(history, index) in debtHistory"> 
                <div>
                    <template v-if="history.type == 'take'">
                        -{{ history.amount }}
                    </template>
                    <template v-else>
                        {{ history.amount }}
                    </template>
                    &nbsp;&nbsp;&nbsp;&nbsp;{{ history.comment }}
                    <a  :href="history.id"
                        @click.prevent="deleteHistoryElement(history.id, index)" 
                        class="secondary-content">
                        <i class="material-icons">delete</i></a>
                    <router-link :to="{ name: 'editDebtHistory', params: { debtId: debtId, debtHistoryId: history.id }}"
                        class="secondary-content">
                        <i class="material-icons">edit</i>
                    </router-link>
                    </div>
                </li>
            </template>
            <template v-else>
                <spinner size="big"></spinner>
            </template>
        </ul>
    </div>
</template>

<script>
import Spinner from 'vue-simple-spinner';

export default {
    components: {
        Spinner
    },

    computed: {
        debtId() {
            return this.$route.params.debtId;
        },

        debtHistory() {
            return this.$store.getters.debtHistory;
        }
    },

    mounted() {
        this.$store.dispatch('loadDebtHistory', this.debtId);
    },

    methods: {
        deleteHistoryElement(historyElementId, elementIndex) {
            this.$store.dispatch('deleteDebtHistoryElement', {
                debtId: this.debtId,
                historyElementId: historyElementId,
                elementIndex: elementIndex
            })
        },

        deleteDebt() {
            this.$store.dispatch('deleteDebt', this.debtId)
                .then(() => {   
                    this.$router.push({ name: 'main'});
                })
                .catch(error => {

                });
        }
    }
}
</script>
