import select2 from 'select2';
import $ from 'jquery';

export default class UserSelect extends HTMLSelectElement {
    connectedCallback() {
        this.endpoint = this.getAttribute('endpoint');
        if (null === this.endpoint) {
            console.error('Unable to  mount user-select element, endpoint attribute has not been defined');
            return
        }
        this.addEventListener('search', this.onSearch)
        $(this).select2({
            ajax: {
                url: '',
                dataType: 'json',
                delay: 500,
                data: params => {
                    return {
                        search: params.term,
                        type: 'public',
                        page: params.page || 1
                    }

                },
                processResults: data => {
                    return {
                        results: data.items
                    }
                }
            }
        })
        
    }

    onSearch(e) {
        const search = e.detail.value;
    }
}