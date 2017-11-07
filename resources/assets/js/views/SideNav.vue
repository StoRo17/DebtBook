<template>
    <div>
        <li>
            <div class="user-view">
                <div class="background green"></div>
                <router-link to="/" exact><img class="circle responsive-img" src="storage/avatars/no_image.jpg"></router-link>
                <router-link to="/" exact><span class="white-text name">John Doe</span></router-link>
                <router-link to="/" exact><span class="white-text email">johndoe@gmail.com</span></router-link>
            </div>
        </li>
        <li><router-link to="/debts-history" class="waves-effect"><i class="material-icons">book</i>История долгов</router-link></li>
        <li><div class="divider"></div></li>
        <li><router-link to="/logout" caption="auth.logout"></router-link></li>
    </div>
</template>

<script>
    export default {

    }
</script>