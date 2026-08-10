<?php

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'content');

function content()
{
    global $post;

    $length = carbon_get_post_meta(get_the_ID(), 'number_of_posts') ?: 10;

    $latest_articles = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => $length,
        'orderby' => 'date',
        'order' => 'DESC',
        'no_found_rows'  => true,
    ]);

    $posts = $latest_articles->posts;
    $post = array_shift($posts); // First post

    ?>
        <section id="hero-section" class="border-bottom border-dark">
            <div class="container">
                <?php if ($post) : setup_postdata($post); ?>
                    <?php get_template_part('components/post', 'hero') ?>
                <?php endif; ?>
            </div>
        </section>
        <section id="latest-article" class="border-bottom border-dark">
            <div class="container">
                <h2 class="mt-2 mb-4 fs-5">
                    <span class="playfair-font text-uppercase ls-wider text-dark h4 border-top border-dark border-thickest">Latest Stories</span>
                </h2>
                <div class="row justify-content-between">
                    <?php foreach ($posts as $index => $post) : setup_postdata($post); ?>
                        <div class="col-sm-6 <?= $index % 2 == 0 ? "col-md-4" : "col-md-3" ?>">
                            <?php get_template_part('components/post', 'square') ?>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
        <?php $categories = carbon_get_post_meta(get_the_ID(), 'categories') ?: []; ?>
        <?php $category_length = carbon_get_post_meta(get_the_ID(), 'number_of_category_posts') ?: 4; ?>
        <?php foreach ($categories as $row): ?>
            <section id="category-<?= $row['category_id'] ?>" class="border-bottom border-dark">
                <?php
                    $category_posts_query = new WP_Query([
                        'post_type'         => 'post',
                        'post_status'       => 'publish',
                        'posts_per_page'    => $category_length,
                        'cat'               => $row['category_id'],
                        'no_found_rows'     => true,
                    ]);
                    $category = get_term($row['category_id'], 'category');
                ?>
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mt-2 mb-4 fs-5">
                            <span class="playfair-font text-uppercase ls-wider text-dark h4 border-top border-dark border-thickest"><?= $category->name ?></span>
                        </h2>
                    </div>
                    <div class="row">
                        <?php while ($category_posts_query->have_posts()): $category_posts_query->the_post(); ?>
                            <?php if ($category_posts_query->current_post == 0): ?>
                                <div class="col-md-6">
                                    <?php get_template_part('components/post', 'lead') ?>
                                    <div class="justify-content-center py-4 d-none d-md-flex">
                                        <a href="<?= get_term_link($category) ?>" class="text-decoration-none">
                                            <span class="fw-light playfair-font fs-4 text-secondary-hover text-dark me-4 text-capitalize">More <?= $category->name ?></span>
                                        </a>
                                        <a href="<?= get_term_link($category) ?>" class="text-decoration-none">
                                            <button style="width: 40px; height: 40px;" class="btn btn-light rounded-circle p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php if ($category_posts_query->current_post == 1): ?>
                                    <div class="col-md-6">
                                        <div class="row">
                                <?php endif; ?>
                                    <div class="col-sm-6">
                                        <?php get_template_part('components/post', 'square') ?>
                                    </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        <?php if ($category_posts_query->post_count > 1): ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-center pb-4 d-md-none">
                            <a href="<?= get_term_link($category) ?>" class="text-decoration-none">
                                <span class="fw-light playfair-font fs-4 text-secondary-hover text-dark me-4 text-capitalize">More <?= $category->name ?></span>
                            </a>
                            <a href="<?= get_term_link($category) ?>" class="text-decoration-none">
                                <button style="width: 40px; height: 40px;" class="btn btn-light rounded-circle p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>
                            </a>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
        <?php get_template_part('components/popular-posts') ?>
    <?php
}

genesis();
