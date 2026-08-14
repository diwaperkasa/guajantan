<?php

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'content');

function content()
{
?>

    <div class="border-bottom border-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="py-4">
                        <h1 class="mb-0">
                            <span class="playfair-font text-uppercase ls-wider text-dark"><?php single_cat_title(); ?></span>
                        </h1>
                        <?php $children = get_categories( ['parent' => get_queried_object_id(), 'hide_empty' => false ]);?>
                        <?php if ($children) : ?>
                            <ul class="mt-3 nav overflow-x-auto align-items-center flex-nowrap text-nowrap w-100 border-bottom border-dark">
                                <?php foreach ($children as $menu): ?>
                                    <li class="nav-item pe-4">
                                        <a class="nav-link p-0 inter-font text-uppercase text-dark" href="<?= $menu->term_url ?>"><?= $menu->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <ul class="list-unstyled post-archive-container">
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post(); ?>
                                <li class="mb-4">
                                    <?php get_template_part('components/post', 'landscape') ?>
                                </li>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <li>
                                <p class="text-secondary">No posts found in this category.</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="d-flex justify-content-center pb-4">
                        <button class="btn d-flex align-items-center p-0 load-more-btn" data-page="2" data-length="10" data-term_id="<?php echo get_queried_object()->term_id; ?>">
                            <span class="fw-light playfair-font fs-4 text-secondary-hover text-dark me-4 text-capitalize">More Stories</span>
                            <span style="width: 40px; height: 40px;" class="btn btn-light rounded-circle p-0 d-flex align-items-center justify-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('components/popular-posts') ?>
<?php
}

genesis();
