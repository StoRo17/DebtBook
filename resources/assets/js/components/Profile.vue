<template>
    <div>
        <div class="row">
            <div class="col s12">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>{{ 'profile.profile' | trans }}</h4></li>
                    <li class="collection-item">Email: {{ user.email }}</li>
                    <li class="collection-item">{{ 'profile.first_name' | trans }}: {{ profile.first_name }}</li>
                    <li class="collection-item">{{ 'profile.last_name' | trans }}: {{ profile.last_name }}</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="right-align hide-on-med-and-down">
                        <router-link :to="{name: 'editProfile'}" class="waves-light btn">{{ 'profile.change_data' | trans }}</router-link>
                        <router-link :to="{name: 'changePassword'}" class="waves-light btn">{{ 'auth.change_password' | trans }}</router-link>
                        <a href="" @click.prevent="logout" class="waves-light btn">{{ 'auth.logout' | trans }}</a>
                    </div>
                </div>
                <div class="col s12 hide-on-large-only center-align">
                    <div class="row">
                        <router-link :to="{name: 'editProfile'}" class="waves-light btn">{{ 'profile.change_data' | trans }}</router-link>
                    </div>
                    <div class="row">
                        <router-link :to="{name: 'changePassword'}" class="waves-light btn">{{ 'auth.change_password' | trans }}</router-link>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <a href="" @click.prevent="logout" class="waves-light btn">{{ 'auth.logout' | trans }}</a>
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
            'profile',
            'profileUpdated'
        ])
    },

    mounted() {
        if (!this.profileUpdated) {
            this.$store.dispatch('loadProfile');
        }
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