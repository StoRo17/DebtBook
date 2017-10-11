<template>
    <div>
        <ul id="slide-out" class="side-nav fixed">
            <li>
                <div class="user-view">
                    <div class="background green accent-4"></div>
                    <a href=""><img class="circle" src="images/no_image.jpg"></a>
                    <a href=""><span class="white-text name">John Doe</span></a>
                    <a href=""><span class="white-text email">johndoe@gmail.com</span></a>
                </div>
            </li>
            <li><a href="" class="waves-effect"><i class="material-icons">cloud</i>First Link With Icon</a></li>
            <li><a href="">Second Link</a></li>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
        </ul>
        <a href="" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</template>

<script>
    export default {
        data () {
            return {}
        },

        mounted () {
            $('.button-collapse').sideNav({
                closeOnClick: true,
                draggable: true
            });
        }
    }
</script>