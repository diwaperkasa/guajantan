<article <?php post_class("mb-4"); ?>>
    <figure class="position-relative">
        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
            <?= get_the_post_thumbnail(get_the_ID(), 'thumbnail', ['class' => 'img-fluid w-100 ratio-1x1']); ?>
        </a>
        <div class="position-absolute start-0 bottom-0 w-100 p-3 p-md-5">
            <div style="--bs-bg-opacity: .5" class="text-center bg-dark p-3">
                <?php
                    $primary_category_id = get_post_meta(
                        get_the_ID(),
                        '_yoast_wpseo_primary_category',
                        true
                    );

                    $primary_category = get_category($primary_category_id);
                ?>
                <?php if ($primary_category && !is_wp_error($primary_category)): ?>
                    <a href="<?= get_term_link($primary_category) ?>" class="text-decoration-none text-white">
                        <p class="text-white fs-small mb-0 fw-light ls-wider text-uppercase"><?= $primary_category->name ?></p>
                    </a>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-white">
                    <h2 class="h3 playfair-font mb-2"><?= get_the_title() ?></h2>
                </a>
                <?php $writers = get_the_terms(get_the_ID(), 'writer'); ?>
                <?php if ($writers && !is_wp_error($writers)): ?>
                    <p class="text-white fs-small fw-light ls-wider mb-0">By
                        <?php foreach ($writers as $writer): ?>
                            <a href="<?= get_term_link($writer) ?>" class="text-decoration-none text-white">
                                <span class="text-capitalize"><?= $writer->name ?></span>
                            </a>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </figure>
</article>