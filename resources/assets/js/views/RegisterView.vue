<template>
    <div class="container">
        <form method="POST">
            <div class="col s12">
                <h2 class="center-align">{{ 'auth.sign_up' | trans }}</h2>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate">
                    <label for="password">{{ 'auth.password' | trans }}</label>
                </div>
            </div>
            <div class="row center-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">{{ 'auth.submit' | trans }}
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</template>