<template>
    <ul class="collection with-header">
        <li class="collection-header"><h4>История долга</h4></li>
        <li class="collection-item" v-for="(history, index) in debtHistory"> 
            <div>
                <template v-if="history.type == 'take'">
                    -{{ history.amount }}
                </template>
                <template v-else>
                    {{ history.amount }}
                </template>
                &nbsp;&nbsp;&nbsp;&nbsp;{{ history.comment }}
                <a :href="history.id" @click.prevent="deleteHistory(history.id, index)" class="secondary-content"><i class="material-icons">delete</i></a>
                <a :href="history.id" class="secondary-content"><i class="material-icons">edit</i></a>                
            </div>
        </li>
      </ul>
</template>

<script>
import api from '../api/debtbook';

export default {
    data() {
        return {
            debtHistory: []
        }
    },

    computed: {
        debtId() {
            return this.$route.params.debtId;
        }
    },

    mounted() {
        api.getDebtHistory(this.debtId)
            .then(response => {
                this.debtHistory = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },

    methods: {
        deleteHistory(historyId, historyIndex) {
            api.deleteDebtHistory(this.debtId, historyId)
                .then(response => {
                    Vue.delete(this.debtHistory, historyIndex);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>
