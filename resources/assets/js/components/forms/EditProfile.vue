<template>
    <form method="POST" class="col s12" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <h3 class="center-align">Edit Profile</h3>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="first_name" name="first_name" v-model="form.first_name" :class="{'invalid': form.errors.has('first_name')}" >
                <label for="first_name" :data-error="form.errors.get('first_name')">First Name</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="last_name" name="last_name" v-model="form.last_name" :class="{'invalid': form.errors.has('last_name')}" >
                <label for="last_name" :data-error="form.errors.get('last_name')">Last Name</label>
            </div>
        </div>
        <div class="row center-align">
            <button class="btn waves-effect waves-light" name="submit">Edit profile
                <i class="material-icons right">edit</i>
            </button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                first_name: '',
                last_name: '',
            })
        }
    }
}
</script>
