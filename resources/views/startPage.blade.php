<div id="start-page">
    <header-nav>
        <router-link slot="logo" to="/" class="brand-logo" exact>DebtBook</router-link>
        <div slot="nav">
            <li><sign-button link-to="/sign_in" caption="auth.sign_in"></sign-button></li>
            <li><sign-button link-to="/sign_up" caption="auth.sign_up"></sign-button></li>
        </div>
        <div slot="side-nav">
            <li><sign-button link-to="/sign_up" caption="auth.sign_up"></sign-button></li>
            <li><sign-button link-to="/sign_in" caption="auth.sign_in"></sign-button></li>
        </div>
    </header-nav>
    <main>
        <router-view></router-view>
    </main>
    <footer>
    </footer>
</div>