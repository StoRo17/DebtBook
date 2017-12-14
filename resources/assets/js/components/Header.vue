<template>
    <header>
        <nav class="green">
            <div class="nav-wrapper">
                <router-link to="/" class="brand-logo" exact>DebtBook</router-link>
                <div id="nav-mobile" class="right hide-on-med-and-down">
                    <li><router-link :to="{name: 'login'}">@{{ 'auth.sign_in' | trans }}</router-link></li>
                    <li><router-link :to="{name: 'register'}">@{{ 'auth.sign_up' | trans }}</router-link></li>
                </div>
                <div id="slide-out" class="side-nav">
                    <li><router-link :to="{name: 'register'}">@{{ 'auth.sign_up' | trans }}</router-link></li>
                    <li><router-link :to="{name: 'login'}">@{{ 'auth.sign_in' | trans }}</router-link></li>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    
}
</script>