<template>
    <div class="container">
        <div class="row">
            <h5 class="center-align">Your Email is successfully verified. Click button below to login</h5>
            <div class="center-align">
                <router-link class="waves-light btn-large"
                             :to="{name: 'login'}">{{ 'auth.sign_in' | trans }}
                </router-link>
            </div>
        </div>
    </div>
</template>