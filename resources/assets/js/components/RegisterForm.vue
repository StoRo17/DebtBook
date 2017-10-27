<template>
    <div class="container">
        <form method="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
            <div class="col s12">
                <h2 class="center-align">{{ 'auth.sign_up' | trans }}</h2>
                <div class="row">
                    <div class="input-field">
                        <input id="email"
                               type="email"
                               name="email"
                               :class="[form.errors.has('email') ? 'invalid' : '']"
                               v-model="form.email">
                        <label for="email"
                               :data-error="form.errors.get('email')">Email
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="password"
                               type="password"
                               name="password"
                               :class="[form.errors.has('password') ? 'invalid' : '']"
                               v-model="form.password">
                        <label for="password"
                               :data-error="form.errors.get('password')">{{ 'auth.password' | trans }}
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               :class="[form.errors.has('password_confirmation') ? 'invalid' : '']"
                               v-model="form.password_confirmation">
                        <label for="password_confirmation"
                               :data-error="form.errors.get('password_confirmation')">{{ 'auth.password_confirmation' | trans }}
                        </label>
                    </div>
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
    import Form from '../Form';

    export default {
        data() {
            return {
                form: new Form({
                    email: '',
                    password: '',
                    password_confirmation: ''
                })
            }
        },

        methods: {
            onSubmit() {
                this.form.post('/auth/register')
                    .then(response => console.log(response))
                    .catch(error => console.log(error.errors));
            }
        }
    }
</script>