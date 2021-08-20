import $ from 'jquery';

$.fn.extend({
    toggleElement() {
        this.each((idx, el) => {
            $(el).on('change', event => {
                event.preventDefault();

                const toggle = $(event.currentTarget);
                const targetElement = $(`#${toggle.data('toggles')}`);

                if (toggle.is(':checked')) {
                    targetElement.show('slow');
                } else {
                    targetElement.hide('slow');
                }
            });

            $(el).trigger('change');
        })
    },
});