
import jquery from "jquery";
import {api} from "@@/js/services/api";
import swal from "sweetalert2";
// import './stimulus-app';


// Registers Stimulus controllers from controllers.json and in the controllers/ directory
// export const app = startStimulusApp(require.context('./controllers', true, /\.(j|t)sx?$/));



window.$ = window.jQuery = jquery;
window.axios = api;
window.swal = window.Swal = swal;

import './js/elements/index';

