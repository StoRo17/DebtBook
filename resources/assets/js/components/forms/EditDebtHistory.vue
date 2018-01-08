<template>
    <form method="POST" class="col s12" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <h3 class="center-align">Edit the debt history element</h3>
        <h4 v-if="name">Name: {{ name }}</h4>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="amount" name="amount" v-model="form.amount" :class="{'invalid': form.errors.has('amount')}" >
                <label for="amount" :data-error="form.errors.get('amount')">Amount</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="comment" name="comment" v-model="form.comment" :class="{'invalid': form.errors.has('comment')}" >
                <label for="comment" :data-error="form.errors.get('comment')">Comment</label>
            </div>
        </div>
        <div class="row center">
            <input name="type" type="radio" id="give" value="give" v-model="form.type" />
            <label for="give">Give</label>
            <input name="type" type="radio" id="take" value="take" v-model="form.type" />
            <label for="take">Take</label>
        </div>
        <div class="row center-align">
            <button class="btn waves-effect waves-light" name="submit">Add debt
                <i class="material-icons right">add</i>
            </button>
        </div>
    </form>
</template>

<script>
import api from '../../api/debtbook';
import Form from '../../Form';
import InputField from './InputField.vue';
import MaterialSelect from './MaterialSelect.vue';

export default {
    components: {
        InputField,
        MaterialSelect
    },

    data() {
        return {
            form: new Form({
                amount: '',
                type: 'give',
                comment: ''
            }),
            name: ''
        }
    },

    computed: {
        currencies() {
            return this.$store.getters.currencies;
        },

        isCurrenciesLoaded() {
            return this.$store.getters.isLoaded;
        },

        debtHistoryElement() {
            return this.$store.getters.debtHistory;
        }
    },

    mounted() {
        if (!this.isCurrenciesLoaded) {
            this.$store.dispatch('loadCurrencies');
        }

        this.getName();
        
        const routeParams = this.$route.params;
        this.$store.dispatch('loadDebtHistoryElement', {
            debtId: routeParams.debtId,
            debtHistoryId: routeParams.debtHistoryId
        })
        .then(() => {
            this.form.amount = this.debtHistoryElement.amount.slice(0, -3);
            this.form.type = this.debtHistoryElement.type;
            this.form.comment = this.debtHistoryElement.comment;
        })
        .catch(error => {
            console.log(error);
        })
    },

    methods: {
        onSubmit() {
            const routeParams = this.$route.params;
            this.$store.dispatch('updateDebtHistoryElement', {
                debtId: routeParams.debtId,
                historyElementId: routeParams.debtHistoryId,
                data: this.form.data()
            }).then(response => {
                this.form.onSuccess();
                this.$router.push({name: 'debtHistory'});
            })
            .catch(error => {
                this.form.onFail(error);
            });
        },

        getName() {
            this.$store.dispatch('loadDebt', this.$route.params.debtId)
                .then(debt => {
                    this.name = debt.name;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>
