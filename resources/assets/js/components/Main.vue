<template>
    <div>
        <template v-if="this.$store.getters.isLoggedIn">
            <div class="row hide-on-med-and-down">
            <div id="add-debt-btn" class="center">
                <router-link  :to="{name: 'newDebt'}" class="waves-effect waves-light btn-large green lighten-1">
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
            <div class="fixed-action-btn hide-on-large-only">
                <router-link :to="{name: 'newDebt'}" class="btn-floating btn-large red waves-effect waves-light">
                    <i class="large material-icons">mode_edit</i>
                </router-link>
            </div>
        </template>
        <template v-else>
            <start></start>
        </template>
    </div>
</template>

<script>
import Start from './Start.vue'
import DebtsCollection from './DebtsCollection.vue';

export default {
    components: {
        Start,
        DebtsCollection
    }
}
</script>