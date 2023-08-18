
import jquery from "./js/plugins/jquery";
import {api} from "@@/js/services/api";
import swal from "sweetalert2";
 import './stimulus-app';


// Registers Stimulus controllers from controllers.json and in the controllers/ directory
// export const app = startStimulusApp(require.context('./controllers', true, /\.(j|t)sx?$/));



window.$ = window.jQuery = jquery;
window.axios = api;
window.swal = window.Swal = swal;

window.Toast = Swal.mixin({
    timerProgressBar: true,
    timer: 1000,
    toast: true
});

import './js/elements/index';

