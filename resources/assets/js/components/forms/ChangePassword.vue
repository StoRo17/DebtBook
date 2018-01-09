<template>
    <form method="POST" class="col s12" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <h3 class="center-align">{{ 'profile.change_password' | trans }}</h3>
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
        <div class="row">
            <input-field inputType="password"
                            name="new_password"
                            v-model="form.new_password"
                            :error="form.errors.get('new_password')"
                            :classes="{'invalid': form.errors.has('new_password')}">{{ 'auth.new_password' | trans }}
            </input-field>
        </div>
        <div class="row center-align">
            <button class="btn waves-effect waves-light" name="submit">{{ 'profile.change_password' | trans }}
                <i class="material-icons right">edit</i>
            </button>
        </div>
    </form>
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
                password: '',
                password_confirmation: '',
                new_password: ''
            })
        }
    },

    methods: {
        onSubmit() {
            this.$store.dispatch('changePassword', {
                userId: this.$store.getters.user.id,
                data: this.form.data()
            }).then(response => {
                this.form.onSuccess();
                this.$router.push({name: 'profile'});
            })
            .catch(error => {
                this.form.onFail(error);
            })
        }
    }
}
</script>
