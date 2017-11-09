<div id="app">
    <header-nav>
        <router-link slot="logo" :to="{name: 'user'}" class="brand-logo center" exact>DebtBook</router-link>
        <template slot="nav" scope="props">
            <li><router-link :to="{name: 'profile'}" class="waves-effect" exact>@{{ props.user.email }}</router-link></li>
            <li><img class="circle responsive-img" src="storage/avatars/no_image.jpg"></li>
        </template>
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