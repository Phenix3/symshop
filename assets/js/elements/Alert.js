export class Alert extends HTMLElement
{
    constructor({type, message} = {}) {
        super();
        if(type !== undefined) {
            this.type = type;
        }

        if (type === 'error' || type === null) {
            this.type = 'danger';
        }
        this.mesage = message;
        this.close = this.close.bind(this);
    }

    close() {
        this.classList.add('out');
    }
}