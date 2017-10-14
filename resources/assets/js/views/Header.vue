<template>
    <header>
        <nav class="green">
            <div class="nav-wrapper">
                <slot name="logo"></slot>
                <a href="" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <slot name="nav"></slot>
                </ul>
                <ul id="slide-out" class="side-nav">
                    <slot name="side-nav"></slot>
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