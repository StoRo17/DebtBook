<template>
    <form method="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <div class="col s12">
            <h2 class="center-align">{{ 'auth.sign_in' | trans }}</h2>
            <div class="row">
                <input-field inputType="email"
                                name="email"
                                v-model="form.email"
                                :error="form.errors.get('email')"
                                :classes="{'invalid': form.errors.has('email')}">Email
                </input-field>
            </div>
            <div class="row">
                <input-field inputType="password"
                                name="password"
                                v-model="form.password"
                                :error="form.errors.get('password')"
                                :classes="{'invalid': form.errors.has('password')}">{{ 'auth.password' | trans }}
                </input-field>
            </div>
            <div class="row center-align">
                <button class="btn waves-effect waves-light" :disabled="form.errors.any()" name="submit">{{ 'auth.sign_in' | trans }}
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import api from '../../api/debtbook';
    import Form from '../../Form';
    import InputField from './InputField.vue';

    export default {
        components: {
            InputField
        },

        data() {
            return {
                form: new Form({
                    email: '',
                    password: ''
                })
            }
        },

        methods: {
            onSubmit() {
                api.login(this.form.data())
                    .then(response => {
                        this.form.onSuccess();
                        this.$store.dispatch('login', response);
                        this.$router.push({name: 'main'})
                    })
                    .catch(error => {
                        this.form.onFail(error);
                    });
            }
        }
    }
</script>