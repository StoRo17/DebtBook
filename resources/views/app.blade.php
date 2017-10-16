<div id="app">
    <header-nav>
        <router-link slot="logo" to="/" class="brand-logo center" exact>DebtBook</router-link>
        <div slot="nav">
            <li><router-link to="/" class="waves-effect" exact>John Doe</router-link></li>
            <li><img class="circle responsive-img" src="storage/avatars/no_image.jpg"></li>
        </div>
        <div slot="side-nav">
            <side-nav></side-nav>
        </div>
    </header-nav>
    <main>
        <div class="container">
            <div class="col s12">
                <div class="row hide-on-med-and-down">
                    <div id="add-debt-btn" class="center">
                        <router-link  to="/new-debt" class="waves-effect waves-light btn-large green lighten-1">
                            <i class="material-icons right">add_box</i>Новый долг
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <h4>Должны:</h4>
                    <div class="divider"></div>
                </div>
                <div class="row">
                    <div class="collection">
                        <router-link to="/" class="collection-item waves-effect">Никита
                            <div class="right">300,00 RUB.
                                <i class="material-icons right">keyboard_arrow_right</i>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4>Должен:</h4>
                <div class="divider"></div>
            </div>
            <div class="row">
                <div class="collection">
                    <router-link to="/" class="collection-item waves-effect">Андрей
                        <div class="right">$100,00
                            <i class="material-icons right">keyboard_arrow_right</i>
                        </div>
                    </router-link>
                </div>
            </div>
            <div class="fixed-action-btn hide-on-large-only">
                <a class="btn-floating btn-large red waves-effect waves-light">
                    <i class="large material-icons">mode_edit</i>
                </a>
            </div>
        </div>
    </main>
</div>