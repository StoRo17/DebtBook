<template>
    <div class="container">
        <form method="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
            <div class="col s12">
                <h2 class="center-align">{{ 'auth.sign_up' | trans }}</h2>
                <div class="row">
                    <input-field inputType="email"
                                 name="email"
                                 v-model="form.email"
                                 :error="form.errors.get('email')"
                                 :classes="{'invalid': form.errors.has('email')}">Email
                    </input-field>
                </div>
                <div class="row">
                    <input-field inputType="text"
                                 name="first_name"
                                 v-model="form.first_name"
                                 :error="form.errors.get('first_name')"
                                 :classes="{'invalid': form.errors.has('first_name')}">First Name
                    </input-field>
                </div>
                <div class="row">
                    <input-field inputType="text"
                                 name="last_name"
                                 v-model="form.last_name"
                                 :error="form.errors.get('last_name')"
                                 :classes="{'invalid': form.errors.has('last_name')}">Last Name
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
                <div class="row">
                    <input-field inputType="password"
                                 name="password_confirmation"
                                 v-model="form.password_confirmation"
                                 :error="form.errors.get('password_confirmation')"
                                 :classes="{'invalid': form.errors.has('password_confirmation')}">{{ 'auth.password_confirmation' | trans }}
                    </input-field>
                </div>
                <div class="row center-align">
                    <button class="btn waves-effect waves-light" :disabled="form.errors.any()" name="submit">{{ 'auth.submit' | trans }}
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
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
                    password: '',
                    password_confirmation: '',
                    first_name: '',
                    last_name: ''
                })
            }
        },

        methods: {
            onSubmit() {
                this.form.post('/api/register')
                    .then(response => {
                        this.$router.push({name: 'verification'});
                    })
                    .catch(error => {
                    });
            }
        }
    }
</script>