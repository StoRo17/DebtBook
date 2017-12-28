<template>
    <form method="POST" class="col s12" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <h3 class="center-align">Add a new debt</h3>
        <div class="row col">
            <input-field inputType="text"
                            name="name"
                            v-model="form.name"
                            :error="form.errors.get('name')"
                            :classes="{'invalid': form.errors.has('name')}"
                            class="col s12">Name
            </input-field>
        </div>
        <div class="row">
            <input-field inputType="text"
                            name="amount"
                            v-model="form.amount"
                            :error="form.errors.get('amount')"
                            :classes="{'invalid': form.errors.has('amount')}"
                            class="col s6">Amount
            </input-field>
            <div class="input-field col s6">
                <material-select v-model="form.currency_id">
                    <option v-for="currency in currencies" :value="currency.id">
                        {{ currency.currency }}
                    </option>
                </material-select>
                <label>Currency</label>
            </div>
        </div>
        <div class="row center">
            <input name="type" type="radio" id="give" value="give" v-model="form.type" />
            <label for="give">Give</label>
            <input name="type" type="radio" id="take" value="take" v-model="form.type" />
            <label for="take">Take</label>
        </div>
        <div class="row">
            <input-field inputType="text"
                            name="comment"
                            v-model="form.comment"
                            :error="form.errors.get('comment')"
                            :classes="{'invalid': form.errors.has('comment')}"
                            class="col s12">Comment
            </input-field>
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
            currencies: [],
            form: new Form({
                name: '',
                amount: '',
                currency_id: '1',
                type: 'give',
                comment: ''
            })
        }
    },

    mounted() {
        api.getCurrencies()
            .then(response => {
                this.currencies = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },

    methods: {
        onSubmit() {
            api.createDebt(this.$store.getters.user.id, this.form.data())
                .then(response => {
                    this.form.onSuccess();
                    this.$store.dispatch('addDebt', response.data);
                    this.$router.push({ name: 'main'});
                })
                .catch(error => {
                    this.form.onFail(error);
                })
        }
    }
}
</script>
