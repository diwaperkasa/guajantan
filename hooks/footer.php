<?php

remove_action('genesis_footer', 'genesis_do_footer');

add_action('genesis_footer', function () {
    include get_stylesheet_directory() . '/components/footer.php';
});