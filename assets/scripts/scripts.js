import bootstrap from 'bootstrap';
import Flickity from 'flickity';

const header = document.querySelector('.top-header');
const nav = document.querySelector('#mainNav');

window.addEventListener("scroll", () => {
    const current = window.scrollY;
    const offsetHeight = header.offsetHeight;

    if (current > offsetHeight) {
        nav.classList.add('navbar-show');
    } else {
        nav.classList.remove('navbar-show');
    }
});

const galleryPostCategory = document.querySelectorAll('.gallery-post-category');

galleryPostCategory.forEach((gallery) => {
    new Flickity(gallery, {
        cellAlign: 'left',
        pageDots: false,
        autoPlay: 3000,
        wrapAround: true
    });
});

const relatedPostGallery = document.querySelector('.related-post-gallery');

if (relatedPostGallery) {
    new Flickity(relatedPostGallery, {
        cellAlign: 'left',
        pageDots: false,
        autoPlay: 3000,
        wrapAround: true
    });
}