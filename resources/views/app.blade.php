<div id="app">
    <header-nav>
        <template slot="logo" scope="props">
            <router-link :to="{name: 'user', params: { id: props.userId }}" class="brand-logo center" exact>DebtBook</router-link>
        </template>
        <template slot="nav" scope="props">
            <li><router-link :to="{name: 'profile', params: { id: props.user.id }}" class="waves-effect" exact>@{{ props.user.email }}</router-link></li>
            <li><img class="circle responsive-img" :src="props.avatar"></li>
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