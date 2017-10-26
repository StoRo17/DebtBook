export default class Form {

    constructor (data) {
        this.data = data;

        for (let field in data) {
            this[field] = data[field];
        }
    }

    
}