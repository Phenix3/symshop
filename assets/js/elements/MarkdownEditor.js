// const SimpleMDE = require('./../plugins/simplemde/src/js/simplemde');
// import '@@/js/plugins/simplemde/src/css/simplemde.css';
import Simplemde from 'simplemde';
import 'simplemde/dist/simplemde.min.css';

export default class MarkdownEditor extends HTMLTextAreaElement
{
    constructor() {
        super();
    }

    connectedCallback() {
        this.sme = new Simplemde({
            element: this
        });
    }

    disconnectedCallback() {
    }
}