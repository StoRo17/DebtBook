<template>
    <div>
        <li>
            <div class="user-view">
                <div class="background green"></div>
                <router-link to="/" exact><span class="white-text name">{{ fullName }}</span></router-link>
                <router-link to="/" exact><span class="white-text email">{{ user.email }}</span></router-link>
            </div>
        </li>
        <li><router-link :to="{name: 'profile'}" class="waves-effect"><i class="material-icons">assignment_ind</i>{{ 'profile.profile' | trans }}</router-link></li>
        <li><div class="divider"></div></li>
        <li><a href="" @click.prevent="logout" >{{ 'auth.logout' | trans }}</a></li>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    computed: {
        fullName() {
            return this.profile.first_name + " " + this.profile.last_name;
        },

        ...mapGetters([
            'user',
            'profile'
        ])
    },

    methods: {
        logout() {
            this.$store.dispatch('logout');
            this.$router.push({name: 'main'});
            location.reload();
        }
    }
}
</script>