<template>
    <div>
        <div class="row">
            <div class="col s12">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Профиль</h4></li>
                    <li class="collection-item">Email: {{ user.email }}</li>
                    <li class="collection-item">Имя: {{ profile.first_name }}</li>
                    <li class="collection-item">Фамилия: {{ profile.last_name }}</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="right-align hide-on-med-and-down">
                        <a href="" class="waves-light btn">Изменить данные</a>
                        <a href="" class="waves-light btn">Сменить пароль</a>
                        <a href="" @click.prevent="logout" class="waves-light btn">Выход</a>
                    </div>
                </div>
                <div class="col s12 hide-on-large-only center-align">
                    <div class="row">
                        <a href="" class="waves-light btn">Изменить данные</a>
                    </div>
                    <div class="row">
                        <a href="" class="waves-light btn">Сменить пароль</a>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <a href="" @click.prevent="logout" class="waves-light btn">Выход</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters([
            'user',
            'profile'
        ])
    },

    methods: {
        logout() {
            this.$store.dispatch('logout');
            location.reload();
            this.$router.push({name: 'main'})
        }
    }
}
</script>