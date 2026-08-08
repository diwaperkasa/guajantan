<?php

remove_action('genesis_header', 'genesis_do_header');

add_action('genesis_header', function () {
    include get_stylesheet_directory() . '/components/header.php';
});