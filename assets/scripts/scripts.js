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

const loadMoreBtn = document.querySelector('.load-more-btn');

if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', async (e) => {
        const button = e.currentTarget; // simpan referensi
        const loader = document.createElement('div');
        loader.classList.add('loader', 'my-2');

        try {
            const length = button.dataset.length;
            let page = parseInt(button.dataset.page, 10);
            const term = button.dataset.term_id;

            const args = {
                action: 'more_article',
                page: page,
                length: length,
                term_id: term
            };

            button.classList.add('d-none');
            button.after(loader);

            const res = await fetch(`/wp-admin/admin-ajax.php?${new URLSearchParams(args)}`)
                .then(async (response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    return response.json();
                });

            if (!res.data.length) return;

            const articleContainer = document.querySelector('.post-archive-container');

            if (!articleContainer) return;

            res.data.forEach((row) => {
                articleContainer.insertAdjacentHTML(
                    'beforeend',
                    `<li class="mb-4">
                        ${row}
                    </li>`
                );
            });

            button.dataset.page = ++page;
        } catch (error) {} finally {
            button.classList.remove('d-none');
            loader.remove();
        }
    });
}