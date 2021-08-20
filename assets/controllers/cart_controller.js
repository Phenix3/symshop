import { Controller } from 'stimulus';

export default class extends Controller
{
    static targets = ['price', 'qte', 'total', 'subTotal'];

    connect() {
        console.log("CartController Connected ");
        this.element.addEventListener('update:total', this.updateTotal);
        console.log(this.targets.has('price'));
    }

    disconnect() {
        this.element.removeEventListener('update:total', this.updateTotal);
    }

    remove(e) {
        e.preventDefault();
        $('.js-cart-table').addClass('loading');
        const $link = e.target; 
        console.log($link);
        swal.fire({
            title: 'Are you sure ?',
            showCancelButton: true,
            icon: 'warning',
            cancelButtonText: 'No, keep it'
        }).then(response => {
            if(response.value) {
                axios.delete($link.getAttribute('href'))
                    .then(response => {
                        swal.fire(
                            'Deleted!',
                            'Item deleted.',
                            'success'
                        );
                    })
                    .catch(error => {
                        console.log(error);
                        swal.fire(
                            'Oops...',
                            'Something look like when wrong.',
                            'error'
                        );
                    })
                $(this.element).fadeOut();
            }
        })
            
        $('.js-cart-table').addClass('loading');
    }

    update(e) {
        console.log('Update ', e);
        const updateTotalEvent = new Event('update:total');
        const totalRow = document.querySelector('#total-row');
        console.log(totalRow);
        totalRow.dispatchEvent(updateTotalEvent);
        this.element.dispatchEvent(updateTotalEvent);

        // SubTotal
        if (this.subTotalTarget) {
            let subTotal = parseFloat(this.subTotalTarget.innerText);
            // console.log('qte ', this.value);
            // console.log('Price ', this.priceTarget.innerText);
            subTotal = parseFloat(Number(this.priceTarget.innerText) * Number(this.qteTarget.value));
            // console.log('SubTotal ', subTotal);
            this.subTotalTarget.innerText = subTotal;

        }

        // Total
        if (this.hasTotalTarget) {
            let total = parseFloat(this.totalTarget.innerText);
            console.log('Total update', total);
        }
    }

    updateTotal(e) {
        console.log('updateTotal triggered', e);
    }

    _dispatchEvent(name, payload = null, canBundle = false, cancelable = false) {
        const userEvent = document.createEvent('CustomEvent');
        userEvent.initCustomEvent(name, canBundle, cancelable, payload);
        this.element.dispatchEvent(userEvent);
    }
}