
const ClassicEditor = require('../plugins/ckeditor5/ckeditor');

export class WysiwygEditor extends HTMLTextAreaElement
{
    constructor() {
        super();
    }

    connectedCallback() {
        console.log(ClassicEditor);
        ClassicEditor
            .create(this)
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.log(err.stack);
            })
    }
}