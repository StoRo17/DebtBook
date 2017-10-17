<template>
    <div>
        <div class="row hide-on-med-and-down">
            <div id="add-debt-btn" class="center">
                <router-link  to="/new-debt" class="waves-effect waves-light btn-large green lighten-1">
                    <i class="material-icons right">add_box</i>{{ 'main.new_debt' | trans }}
                </router-link>
            </div>
        </div>
        <div class="row">
            <h4>{{ 'main.debts' | trans }}</h4>
            <div class="divider"></div>
        </div>
        <div class="row">
            <debts-collection></debts-collection>
        </div>
        <div class="row">
            <h4>{{ 'main.owes' | trans }}</h4>
            <div class="divider"></div>
        </div>
        <div class="row">
            <debts-collection></debts-collection>
        </div>
        <div class="fixed-action-btn hide-on-large-only">
            <router-link to="/new-debt" class="btn-floating btn-large red waves-effect waves-light">
                <i class="large material-icons">mode_edit</i>
            </router-link>
        </div>
    </div>
</template>

<script>
    import DebtsCollection from '../components/DebtsCollection.vue'

    export default {
        components: {
            'debts-collection': DebtsCollection
        }
    }
</script>