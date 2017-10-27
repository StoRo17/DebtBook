export default class Errors {

    constructor() {
        this.errors = {}
    }

    get(key) {
        if (this.errors[key]) {
            return this.errors[key][0];
        }
    }

    set(errors) {
        this.errors = errors;
    }

    has(key) {
        return this.errors.hasOwnProperty(key);
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    clear(field) {
        if (field) {
            delete this.errors[field];
        } else {
            this.errors = {};
        }
    }
}