// Imports

import {addDeleteForms, addPatchForms, bindDeleteForms, bindPatchForms} from  './plugins/action-buttons';

$(() => {
    addDeleteForms();
    bindDeleteForms();
    addPatchForms();
    bindPatchForms();
});
/*
require('./plugins/jquery.dataTables.min');
require('./plugins/dataTables.bootstrap.min');

$('table').DataTable();*/
