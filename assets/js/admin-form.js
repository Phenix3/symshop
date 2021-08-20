// SCSS imports
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import 'flatpickr/dist/themes/material_green.css';
import {French} from 'flatpickr/dist/l10n/fr.js';
import a2lix_lib from "@@/js/plugins/a2lix_sf_collection";
// import './../scss/lib/flatpickr.scss'
require('./../scss/admin-form.scss');
require('./plugins/select2.min');
// require('./plugins/bootstrap-datepicker.min');
require("./plugins/form-collection");
require("./plugins/a2lix_sf_collection");


$('select').select2();

// $('[data-toggle="datetimepicker"]').datepicker();
flatpickr('[data-toggle="datepicker"]', {
    locale: French,
    altFormat: 'd F Y H:i',
    dateFormat: "Y-m-d H:i:s",
    altInput: false,
    enableTime: false,
});

$('[data-form-type="collection"]').CollectionForm();
a2lix_lib.sfCollection.init();
