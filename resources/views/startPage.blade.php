<div id="start-page">
    <header-nav>
        <router-link slot="logo" to="/" class="brand-logo" exact>DebtBook</router-link>
        <div slot="nav">
            <li><router-link :to="{name: 'auth'}">@{{ 'auth.sign_in' | trans }}</router-link></li>
            <li><router-link :to="{name: 'register'}">@{{ 'auth.sign_up' | trans }}</router-link></li>
        </div>
        <div slot="side-nav">
            <li><router-link :to="{name: 'register'}">@{{ 'auth.sign_up' | trans }}</router-link></li>
            <li><router-link :to="{name: 'auth'}">@{{ 'auth.sign_in' | trans }}</router-link></li>
        </div>
    </header-nav>
    <main>
        <router-view></router-view>
    </main>
    <footer>
    </footer>
</div>