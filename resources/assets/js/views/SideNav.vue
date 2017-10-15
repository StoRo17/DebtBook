<template>
    <div>
        <li><user-info name="John" email="johndoe@gmail.com" avatar="storage/avatars/no_image.jpg"></user-info></li>
        <li><router-link to="/debts-history" class="waves-effect"><i class="material-icons">book</i>История долгов</router-link></li>
        <li><div class="divider"></div></li>
        <li><sign-button link-to="/logout" caption="auth.logout"></sign-button></li>
    </div>
</template>

<script>
    import UserInfo from '../components/UserInfo.vue';

    export default {
        components: {
            'user-info': UserInfo
        }
    }
</script>