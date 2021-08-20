import Swal from 'sweetalert2';
import {api} from '@@/js/services/api';

window.Swal = Swal;


export function addDeleteForms() {
    $('[data-method="DELETE"]').append(function () {
        if (!$(this).find('form').length > 0) {
            return "\n<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                "<input type='hidden' name='_token' value='" + $(this).attr('data-csrf-token') + "'>\n" +
                '</form>\n';
        } else { return '' }
    })
        .attr('href', '#')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

export function bindDeleteForms() {
    $('body').on('submit', 'form[name=delete_item]', function (e) {
        e.preventDefault();

        const form = this;
        const link = $('a[data-method="delete"]');
        const cancel = 'Cancel';
        const confirm = 'Yes, delete';
        const title = 'Are you sure you want to delete this item?';

        Swal.fire({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            icon: 'warning'
        }).then((result) => {
            result.value && form.submit();
        });
    });
}

export function addPatchForms() {
    $('[data-method="PATCH"]').append(function () {
        if (!$(this).find('form').length > 0) {
            return "\n<form action='" + $(this).attr('href') + "' method='POST' name='edit_item' style='display:none'>\n" +
                "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                "<input type='hidden' name='_token' value='" + $(this).attr('data-csrf-token') + "'>\n" +
                "<input type='hidden' name='" + $(this).attr('data-field') + "' value='" + $(this).attr('data-value') + "'>\n" +
                '</form>\n';
        } else {
            return '';
        }
    })
        .attr('href', '#')
        .attr('style', 'cursor: pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

export function bindPatchForms() {
    $('body').on('submit', 'form[name="edit_item"]', function (e) {
        e.preventDefault();

        const form = this;
        const $form = $(this);
        const link = $form.parent('a');
        const cancel = 'Cancel';
        const confirm = 'Yes, edit';
        const title = 'Are you sure you want to edit this item?';

        Swal.fire({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            icon: 'warning'
        }).then((result) => {
            const field = $form.parent('a').attr('data-field');
            const value = $form.parent('a').attr('data-value');
            console.log(form, field, value);
            if (result.value) {
                api.patch($form.attr('action'), {
                    [field]: value
                }, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    console.log(response);
                    link.attr('disabled', 'disabled').addClass('disabled');
                }).catch(error => {
                    console.log(error);
                    Swal.fire('Oops!', 'Something look like wen wrong.', 'error');
                });
            }
        });
    });
}

export function bindConfirmItem() {
    $('body').on('click', 'a[name=confirm_item]', function (e) {
        /**
         * Generic 'are you sure' confirm box
         */
        e.preventDefault();

        const link = $(this);
        const title = 'Are you sure you want to do this?';
        const cancel = 'Cancel';
        const confirm = 'Continue';

        Swal.fire({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            icon: 'info'
        }).then((result) => {
            result.value && window.location.assign(link.attr('href'));
        });
    })
    ;
}


