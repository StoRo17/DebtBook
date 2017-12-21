<template>
    <header>
        <nav class="green">
            <div class="nav-wrapper">
                <router-link to="/" class="brand-logo center" exact>DebtBook</router-link>
                <a href="" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <template v-if="isLoggedIn">
                        <li><router-link :to="{name: 'profile'}">{{ fullName }}</router-link></li>
                        <img :src="profile.avatar" class="circle">
                    </template>
                    <template v-else>
                        <li><router-link :to="{name: 'login'}">{{ 'auth.sign_in' | trans }}</router-link></li>
                        <li><router-link :to="{name: 'register'}">{{ 'auth.sign_up' | trans }}</router-link></li>
                    </template>
                </ul>
                <ul id="slide-out" class="side-nav">
                    <template v-if="isLoggedIn">
                        <side-nav></side-nav>
                    </template>
                    <template v-else>       
                        <li><router-link :to="{name: 'register'}">{{ 'auth.sign_up' | trans }}</router-link></li>
                        <li><router-link :to="{name: 'login'}">{{ 'auth.sign_in' | trans }}</router-link></li>
                    </template>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
import { mapGetters } from 'vuex';
import SideNav from './SideNav.vue';

export default {
    components: {
        SideNav
    },

    computed: {
        fullName() {
            return this.profile.first_name + " " + this.profile.last_name;
        },

        ...mapGetters([
            'isLoggedIn',
            'profile'
        ])
    },

    mounted() {
            $( document ).ready(function(){
                $(".button-collapse").sideNav({
                    closeOnClick: true,
                    draggable: true
                });
            });
        }
}
</script>