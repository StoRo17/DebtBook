<template>
    <header>
        <nav class="green">
            <div class="nav-wrapper">
                <router-link to="/" class="brand-logo center" exact>DebtBook</router-link>
                <a href="" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><router-link :to="{name: 'login'}">{{ 'auth.sign_in' | trans }}</router-link></li>
                    <li><router-link :to="{name: 'register'}">{{ 'auth.sign_up' | trans }}</router-link></li>
                </ul>
                <ul id="slide-out" class="side-nav">
                    <li><router-link :to="{name: 'register'}">{{ 'auth.sign_up' | trans }}</router-link></li>
                    <li><router-link :to="{name: 'login'}">{{ 'auth.sign_in' | trans }}</router-link></li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    mounted() {
            $( document ).ready(function(){
                $(".button-collapse").sideNav({
                    closeOnClick: true,
                    draggable: true
                });
            });
        }
}
</script>