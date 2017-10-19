<template>
    <div class="container">
        <form method="POST">
            <div class="col s12">
                <h2 class="center-align">{{ 'auth.sign_up' | trans }}</h2>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" v-model="email">
                        <label for="email">Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" v-model="password">
                    <label for="password">{{ 'auth.password' | trans }}</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password_confirmation" type="password" v-model="passwordConfirmation">
                    <label for="password_confirmation">{{ 'auth.password_confirmation' | trans }}</label>
                </div>
            </div>
            <div class="row center-align">
                <button class="btn waves-effect waves-light" name="action">{{ 'auth.submit' | trans }}
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
                passwordConfirmation: '',
            }
        }
    }
</script>