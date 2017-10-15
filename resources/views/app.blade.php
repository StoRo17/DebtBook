<div id="app">
    <header-nav class="hide-on-large-only">
        <router-link slot="logo" to="/" class="brand-logo center" exact>DebtBook</router-link>
        <div slot="side-nav">
            <side-nav></side-nav>
        </div>
    </header-nav>
    <main>
        <div class="row">
            <div class="col s12 m4 l3">
                <ul id="slide-out" class="side-nav fixed">
                    <side-nav></side-nav>
                </ul>
            </div>
        </div>
    </main>
</div>