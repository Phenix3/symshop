import Glightbox from 'glightbox';
import './../css/app-product-show.scss';

const lightbox = Glightbox({
    loop: true,
    touchNavigation: true,
    openEffect: 'bounce',
    cssEfects: {
        zoom: {in: 'zoomIn', out: 'zoomOut'},
        bounce: {in: 'bounceIn', out: 'bounceOut'},
    }
});

// lightbox.