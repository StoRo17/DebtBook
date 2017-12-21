<template>
    <div>
        <li>
            <div class="user-view">
                <div class="background green"></div>
                <router-link to="/" exact><img class="circle responsive-img" :src="profile.avatar"></router-link>
                <router-link to="/" exact><span class="white-text name">{{ fullName }}</span></router-link>
                <router-link to="/" exact><span class="white-text email">{{ user.email }}</span></router-link>
            </div>
        </li>
        <li><router-link :to="{name: 'profile'}" class="waves-effect"><i class="material-icons">assignment_ind</i>Профиль</router-link></li>
        <li><div class="divider"></div></li>
        <li><router-link to="/logout">{{ 'auth.logout' | trans }}</router-link></li>
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
    }
}
</script>