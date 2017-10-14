<template>
    <router-link :to="linkTo" class="waves-effect"> {{ caption | trans }}</router-link>
</template>

<script>
    export default {
        props: ['linkTo', 'caption']
    }
</script>