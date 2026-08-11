<article <?php post_class("my-4"); ?>>
    <figure class="position-relative">
        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
            <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'ratio-16x9 img-fluid w-100']); ?>
        </a>
        <div class="position-absolute start-0 top-0 w-100 d-flex justify-content-center mt-n3">
            <div class="bg-white p-1 border border-dark">
                <div class="p-2 border border-dark">
                    TOP STORY
                </div>
            </div>
        </div>
    </figure>
    <?php
    $primary_category_id = get_post_meta(
        get_the_ID(),
        '_yoast_wpseo_primary_category',
        true
    );

    $primary_category = get_category($primary_category_id);
    ?>
    <?php if ($primary_category && !is_wp_error($primary_category)): ?>
        <a href="<?= get_term_link($primary_category) ?>" class="text-decoration-none text-secondary text-center">
            <p class="text-secondary mb-0 fw-light ls-wider text-uppercase"><?= $primary_category->name ?></p>
        </a>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark text-secondary-hover">
        <h1 class="playfair-font mb-3 text-center"><?= get_the_title() ?></h1>
    </a>
    <?php $writers = get_the_terms(get_the_ID(), 'writer'); ?>
    <?php if ($writers && !is_wp_error($writers)): ?>
        <p class="text-secondary fw-light ls-wider mb-0 text-center">By
            <?php foreach ($writers as $writer): ?>
                <a href="<?= get_term_link($writer) ?>" class="text-decoration-none text-secondary">
                    <span class="text-capitalize"><?= $writer->name ?></span>
                </a>
            <?php endforeach; ?>
        </p>
    <?php endif; ?>
</article>