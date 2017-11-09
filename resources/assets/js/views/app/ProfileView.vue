<template>
    <div v-if="loaded">
        <div class="row">
            <div class="col s12 center-align hide-on-large-only">
                <a href="/" class="waves-light btn" style="margin-top: 10px;">Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 l3">
                <div class="center-align">
                    <img class="circle responsive-img" :src="profile.avatar">
                </div>
            </div>
            <div class="col s12 m6 l9">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Профиль</h4></li>
                    <li class="collection-item">Email: {{ user.email }}</li>
                    <li class="collection-item">Имя: {{ profile.first_name }}</li>
                    <li class="collection-item">Фамилия: {{ profile.last_name }}</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l3 hide-on-med-and-down">
                <div class="row">
                    <div class="center-align">
                        <a href="/" class="waves-light btn">Назад</a>
                    </div>
                </div>
            </div>
            <div class="col s12 l9">
                <div class="row">
                    <div class="right-align hide-on-med-and-down">
                        <a href="" class="waves-light btn">Изменить данные</a>
                        <a href="" class="waves-light btn">Сменить пароль</a>
                        <a href="" class="waves-light btn">Выход</a>
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
                        <a href="/" class="waves-light btn">Выход</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loaded: false,
                user: null,
                profile: null,
            }
        },

        created() {
            this.$router.app.$on('user-loaded', (user) => {
               this.user = user;
               this.getProfile(user.id);
            });
        },

        methods: {
            getProfile(userId) {
                axios.get('/users/' + userId + '/profile')
                    .then(response => {
                        this.profile = response.data[0];
                        this.loaded = true;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>