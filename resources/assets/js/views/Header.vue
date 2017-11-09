<template>
    <header>
        <nav class="green">
            <div class="nav-wrapper" v-if="loaded">
                <slot name="logo" :user-id="user.id"></slot>
                <a href="" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <slot name="nav" :user="user" :avatar="avatar"></slot>
                </ul>
                <ul id="slide-out" class="side-nav">
                    <slot name="side-nav"></slot>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        data() {
            return {
                loaded: false,
                user: null,
                avatar: null
            }
        },

        created() {
            this.$router.app.$on('user-loaded', (user) => {
                this.user = user;
                this.getAvatar(user.id);
            });
        },

        mounted() {
            $( document ).ready(function(){
                $(".button-collapse").sideNav({
                    closeOnClick: true,
                    draggable: true
                });
            });
        },

        methods: {
            getAvatar(userId) {
                axios.get('/users/' + userId + '/profile')
                    .then(response => {
                        this.avatar = response.data[0].avatar;
                        this.loaded = true;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>