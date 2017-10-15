<template>
    <div class="user-view">
        <div class="background green"></div>
        <router-link to="/" exact><img class="circle responsive-img" :src="avatar"></router-link>
        <router-link to="/" exact><span class="white-text name">{{ name }}</span></router-link>
        <router-link to="/" exact><span class="white-text email">{{ email }}</span></router-link>
    </div>
</template>

<script>
    export  default {
        props: ['name', 'email', 'avatar']
    }
</script>