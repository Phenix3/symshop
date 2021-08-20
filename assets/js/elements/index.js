import { DatePicker } from './DatePicker';
import { Switch } from './Switch';
import { WysiwygEditor } from './WysiwygEditor';
import InputAttachment from "@@/js/elements/InputAttachment";
import MarkdownEditor from "@@/js/elements/MarkdownEditor";

customElements.define('date-time-picker', DatePicker, {extends: 'input'});
customElements.define('input-switch', Switch, {extends: 'input'});
customElements.define('wysiwyg-editor', WysiwygEditor, {extends: 'textarea'});
customElements.define('markdown-editor', MarkdownEditor, {extends: 'textarea'});
customElements.define('input-attachment', InputAttachment, {extends: 'input'});