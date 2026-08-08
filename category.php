<?php

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'content');

function content()
{
?>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="py-4">
                    <div class="border-bottom border-dark">
                        <h1 class="category__title kepler fw-bold text-uppercase h2"><?php single_cat_title(); ?></h1>
                    </div>
                </div>
                <?php while (have_posts()) : the_post(); ?>
                    <?php $categories = get_the_category(); ?>
                    <div class="border-bottom mb-4">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="post__thumbnail">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                        <?php the_post_thumbnail('full', ['class' => 'img-fluid w-100 mb-4 ratio-16x9']); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <?php if ($categories) : ?>
                                    <div class="post__categories">
                                        <a href="<?= get_category_link($categories[0]->term_id); ?>" class="text-decoration-none text-danger text-uppercase karla fs-6 fw-bold mb-3">
                                            <?= $categories[0]->name; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <h3 class="kepler h2 text-danger-hover"><?= the_title() ?></h3>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>

<?php
}

genesis();
