<template>
    <form method="POST" class="col s12">
        <h3 class="center-align">Add a new debt</h3>
        <div class="row">
            <div class="input-field col s12">
                <input id="name" name="name" type="text" class="validate">
                <label for="name">Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input placeholder="100.00" id="amount" name="amount" type="text" class="validate">
                <label for="amount">Amount</label>
            </div>
            <div class="input-field col s6">
                <select name="currency_id">
                    <option value="1">RUB</option>
                    <option value="2">USD</option>
                </select>
                <label>Currency</label>
            </div>
        </div>
        <div class="row center">
            <input name="type" type="radio" id="give" value="give" checked/>
            <label for="give">Give</label>
            <input name="type" type="radio" id="take" value="take" />
            <label for="take">Take</label>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="comment" name="comment" type="text" class="validate">
                <label for="comment">Comment</label>
            </div>
        </div>
        <div class="row center-align">
            <button class="btn waves-effect waves-light" name="submit">Add debt
                <i class="material-icons right">add</i>
            </button>
        </div>
    </form>
</template>

<script>
export default {
    mounted() {
         $(document).ready(function() {
            $('select').material_select();
        });
    }
}
</script>
