<?php

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'content');

function content()
{
?>
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <div class="container">
                <header class="post__header my-4" role="heading">
                    <?php
                        $primary_category_id = get_post_meta(
                            get_the_ID(),
                            '_yoast_wpseo_primary_category',
                            true
                        );

                        $primary_category = get_category($primary_category_id);
                    ?>
                    <div class="d-flex justify-content-between">
                        <?php if ($primary_category && !is_wp_error($primary_category)): ?>
                            <a href="<?= get_term_link($primary_category) ?>" class="text-decoration-none text-secondary">
                                <p class="inter-font text-secondary fs-small mb-0 fw-light ls-wider text-uppercase mb-3"><?= $primary_category->name ?></p>
                            </a>
                        <?php endif; ?>
                        <p class="inter-font text-danger fs-small mb-0 ls-wider text-uppercase mb-3"><?= get_the_date('j F, Y'); ?></p>
                    </div>
                    <h1 class="post__title playfair-font mb-3"><?php the_title(); ?></h1>
                    <?php if ($secondaryTitle = get_post_meta(get_the_ID(), '_secondary_title', true)): ?>
                        <p class="inter-font fs-5 mb-3 text-secondary fst-italic"><?= $secondaryTitle; ?></p>
                    <?php endif; ?>
                </header>
            </div>

            <section class="border-bottom border-dark">
                <div class="container container-hero">
                    <div class="post__thumbnail">
                        <figure>
                            <?php the_post_thumbnail('full', ['class' => 'img-fluid w-100']); ?>
                        </figure>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="post__content fs-5">
                                <?php the_content(); ?>
                            </div>
                            <?php $tags = get_the_tags(get_the_ID()); ?>
                            <?php if ($tags): ?>
                                <div class="post__tags">
                                    <nav class="playfair-font">
                                        <h3 class="text-uppercase fs-6 fw-bold">Read More About:</h3>
                                        <ol class="list-unstyled d-flex flex-wrap gap-2">
                                            <?php foreach ($tags as $tag): ?>
                                                <li><a href="<?= get_tag_link($tag->term_id); ?>" class="text-decoration-none text-danger text-uppercase"><?= $tag->name; ?></a></li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </nav>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <?php get_template_part('components/related-posts') ?>
                        </div>
                    </div>
                </div>
            </section>
        </article>
        <?php get_template_part('components/popular-posts') ?>
    <?php endwhile; ?>
<?php
}

genesis();
