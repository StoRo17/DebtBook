<template>
    <router-link to="/" class="collection-item waves-effect">{{ name }}
        <div class="right">{{ currency }}{{ amount }}
            <i class="material-icons right">keyboard_arrow_right</i>
        </div>
    </router-link>
</template>

<script>
    export default {
        props: ['name', 'amount', 'currency']
    }
</script>