$(() => {
    $('[data-card-button]').each((idx, el) => {
        $(el).on('click', (e) => {
            e.preventDefault();
            const _this = $(e.currentTarget);
            const target = $(_this).attr('data-target-path');
            const redirect = $(_this).attr('data-redirect-path');
            const reload = $(_this).attr('data-reload');
            const productId = $(_this).attr('data-product-id');
            let quantity = $(_this).attr('data-product-quantity');

            console.log(quantity);

            axios.post(target, {id: productId, quantity})
                .then(res => {
                    if(reload) {
                        window.location.reload()
                    } else if(redirect) {
                        window.location = redirect;
                    }

                    window.Toast.fire('Product added to cart.');
                })
                .catch(err => {
                    console.log(err);
                })
        })
    })
})