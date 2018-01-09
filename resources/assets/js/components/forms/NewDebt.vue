<template>
    <form method="POST" class="col s12" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <h3 class="center-align">{{ 'debts.add_debt' | trans }}</h3>
        <div class="row col">
            <input-field inputType="text"
                            name="name"
                            v-model="form.name"
                            :error="form.errors.get('name')"
                            :classes="{'invalid': form.errors.has('name')}"
                            class="col s12">{{ 'debts.name' | trans }}
            </input-field>
        </div>
        <div class="row">
            <input-field inputType="text"
                            name="amount"
                            v-model="form.amount"
                            :error="form.errors.get('amount')"
                            :classes="{'invalid': form.errors.has('amount')}"
                            class="col s6">{{ 'debts.amount' | trans }}
            </input-field>
            <div class="input-field col s6">
                <material-select v-model="form.currency_id">
                    <option v-for="currency in currencies" :value="currency.id">
                        {{ currency.currency }}
                    </option>
                </material-select>
                <label>{{ 'debts.currency' | trans }}</label>
            </div>
        </div>
        <div class="row center">
            <input name="type" type="radio" id="give" value="give" v-model="form.type" />
            <label for="give">{{ 'debts.give' | trans }}</label>
            <input name="type" type="radio" id="take" value="take" v-model="form.type" />
            <label for="take">{{ 'debts.take' | trans }}</label>
        </div>
        <div class="row">
            <input-field inputType="text"
                            name="comment"
                            v-model="form.comment"
                            :error="form.errors.get('comment')"
                            :classes="{'invalid': form.errors.has('comment')}"
                            class="col s12">{{ 'debts.comment' | trans }}
            </input-field>
        </div>
        <div class="row center-align">
            <button class="btn waves-effect waves-light" name="submit">{{ 'debts.add_debt' | trans }}
                <i class="material-icons right">add</i>
            </button>
        </div>
    </form>
</template>

<script>
import Form from '../../Form';
import InputField from './InputField.vue';
import MaterialSelect from './MaterialSelect.vue';
import { mapGetters } from 'vuex';

export default {
    components: {
        InputField,
        MaterialSelect
    },
    
    data() {
        return {
            form: new Form({
                name: '',
                amount: '',
                currency_id: '1',
                type: 'give',
                comment: ''
            })
        }
    },

    computed: {
        ...mapGetters([
            'currencies',
            'debts'
        ]),

        ...mapGetters({
            isDebtsLoaded: 'loaded',
            isCurrenciesLoaded: 'isLoaded'
        }),

        userId() {
            return this.$store.getters.user.id;
        }
    },

    mounted() {
        if (!(this.isDebtsLoaded && this.isCurrenciesLoaded)) {
            this.$store.dispatch('loadCurrencies', this.userId);
            this.$store.dispatch('loadDebts', this.userId);
        }
    },

    methods: {
        onSubmit() {
            let debt = this.findDebt(this.form);
            if (debt) {
                this.$store.dispatch('createDebtHistory', {
                    debtId: debt.id,
                    data: this.form.data()
                })
                    .then(() => {
                        this.form.onSuccess();
                        this.$router.push({ name: 'main'});
                    })
                    .catch(error => {
                        this.form.onFail(error);
                    });
            } else {
                this.$store.dispatch('createDebt', this.form.data())
                    .then(() => {
                        this.form.onSuccess();
                        this.$router.push({ name: 'main'});
                    })
                    .catch(error => {
                        this.form.onFail(error);
                    });
            }
        },

        findDebt(form) {
            for (let debt of this.debts) {
                if (form.name == debt.name && form.currency_id == debt.currency_id) {
                    return debt;
                }
            }

            return false;
        }
    }
}
</script>
