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
        <div class="parallax-container">
            <div class="section">
                <div class="row container">
                    <h2>Debt Book</h2>
                    <sign-button class="waves-light btn-large red"
                                 link-to="/sign_up"
                                 caption="auth.sign_up">
                    </sign-button>
                </div>
            </div>
        </div>
    </main>
    <footer>

    </footer>
</div>