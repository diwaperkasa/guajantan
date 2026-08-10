<?php
$related_posts = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'post__not_in' => [get_the_ID()],
    'orderby' => 'rand',
    'tax_query' => [
        [
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => wp_get_post_categories(get_the_ID()),
        ],
    ],
]);
?>
<h2 class="mt-2 mb-4 fs-5">
    <span class="playfair-font text-uppercase ls-wider text-dark h4 border-top border-dark border-thickest">You Will Like it</span>
</h2>
<ul class="list-unstyled">
    <?php while ($related_posts->have_posts()): $related_posts->the_post(); ?>
        <li class="mb-3">
            <?php get_template_part('components/post', 'list') ?>
        </li>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</ul>