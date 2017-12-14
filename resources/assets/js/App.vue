<template>
    <div id="app">
        <header-nav></header-nav>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import HeaderNav from './components/Header.vue';

export default {
    components: {
        HeaderNav
    }
}
</script>
