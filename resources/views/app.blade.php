<div id="app">
    <header-nav>
        <router-link slot="logo" :to="{name: 'main'}" class="brand-logo center" exact>DebtBook</router-link>
        <div slot="nav">
            <li><router-link :to="{name: 'main'}" class="waves-effect" exact>John Doe</router-link></li>
            <li><img class="circle responsive-img" src="storage/avatars/no_image.jpg"></li>
        </div>
        <div slot="side-nav">
            <side-nav></side-nav>
        </div>
    </header-nav>
    <main>
        <div class="container">
            <div class="col s12">
                <router-view></router-view>
            </div>
        </div>
    </main>
</div>