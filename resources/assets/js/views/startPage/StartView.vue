<template>
    <div class="parallax-container">
        <div class="section">
            <div class="row container">
                <h2>Debt Book</h2>
                <router-link class="waves-light btn-large red"
                             :to="{name: 'register'}">{{ 'auth.sign_up' | trans }}
                </router-link>
            </div>
        </div>
    </div>
</template>
