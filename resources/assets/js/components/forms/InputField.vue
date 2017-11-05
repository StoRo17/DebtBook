<template>
    <div class="input-field">
        <input :id="name"
               ref="input"
               :type="type"
               :name="name"
               :class="inputClasses"
               :value="value"
               @input="updateText($event.target.value)">
        <label :for="name" :data-error="error"><slot></slot></label>
    </div>
</template>

<script>
    export default {
        props: ['type', 'name', 'text', 'error', 'inputClasses'],

        data() {
            return {
                value: this.text
            }
        },

        methods: {
            updateText(value) {
                this.value = value;
                this.$refs.input.value = value;
                this.$emit('input', value);
            }
        }
    }
</script>