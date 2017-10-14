<div id="app">
    <header-nav class="hide-on-large-only">
        <router-link slot="logo" to="/" class="brand-logo center" exact>DebtBook</router-link>
        <div slot="side-nav">
            <li>
                <div class="user-view">
                    <div class="background green"></div>
                    <a href=""><img class="circle" src="storage/avatars/no_image.jpg"></a>
                    <a href=""><span class="white-text name">John Doe</span></a>
                    <a href=""><span class="white-text email">johndoe@gmail.com</span></a>
                </div>
            </li>
            <li><a href="" class="waves-effect"><i class="material-icons">cloud</i>First Link With Icon</a></li>
            <li><a href="">Second Link</a></li>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
            <li><sign-button link-to="/logout" caption="auth.logout"></sign-button></li>
        </div>
    </header-nav>
    <div class="row">
        <div class="col s12 m4 l3">
            <ul id="slide-out" class="side-nav fixed">
                <li>
                    <div class="user-view">
                        <div class="background green"></div>
                        <a href=""><img class="circle" src="storage/avatars/no_image.jpg"></a>
                        <a href=""><span class="white-text name">John Doe</span></a>
                        <a href=""><span class="white-text email">johndoe@gmail.com</span></a>
                    </div>
                </li>
                <li><a href="" class="waves-effect"><i class="material-icons">cloud</i>First Link With Icon</a></li>
                <li><a href="">Second Link</a></li>
                <li><div class="divider"></div></li>
                <li><a class="subheader">Subheader</a></li>
                <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
                <li><sign-button link-to="/logout" caption="auth.logout"></sign-button></li>
            </ul>
        </div>
    </div>
</div>