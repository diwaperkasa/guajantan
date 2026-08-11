<article <?php post_class("mb-3 border-bottom"); ?>>
    <?php
        $primary_category_id = get_post_meta(
            get_the_ID(),
            '_yoast_wpseo_primary_category',
            true
        );

        $primary_category = get_category($primary_category_id);
    ?>
    <?php if ($primary_category && !is_wp_error($primary_category)): ?>
        <a href="<?= get_term_link($primary_category) ?>" class="text-decoration-none text-secondary">
            <p class="text-secondary mb-0 fw-light ls-wider text-uppercase"><?= $primary_category->name ?></p>
        </a>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark text-secondary-hover">
        <h2 class="h5 playfair-font mb-2"><?= get_the_title() ?></h2>
    </a>
    <?php $writers = get_the_terms(get_the_ID(), 'writer'); ?>
    <?php if ($writers && !is_wp_error($writers)): ?>
        <p class="text-secondary fw-light ls-wider mb-0">By
            <?php foreach ($writers as $writer): ?>
                <a href="<?= get_term_link($writer) ?>" class="text-decoration-none text-secondary">
                    <span class="text-capitalize"><?= $writer->name ?></span>
                </a>
            <?php endforeach; ?>
        </p>
    <?php endif; ?>
</article>