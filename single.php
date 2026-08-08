<?php

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'content');

function content()
{
?>
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <header class="post__header my-4" role="heading">
                    <h1 class="post__title fw-bold kepler"><?php the_title(); ?></h1>
                    <?php if ($secondaryTitle = get_post_meta( get_the_ID(), '_secondary_title', true )): ?>
                        <p class="karla fs-5"><?= $secondaryTitle; ?></p>
                    <?php endif; ?>
                </header>

                <section class="border-bottom border-dark">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="post__thumbnail">
                                <?php the_post_thumbnail('full', ['class' => 'img-fluid w-100 mb-4']); ?>
                            </div>
                            <div class="post__content fs-5">
                                <?php the_content(); ?>
                            </div>
                            <?php $tags = get_the_tags(get_the_ID()); ?>
                            <?php if ($tags): ?>
                            <div class="post__tags">
                                <nav class="karla">
                                    <h3 class="text-uppercase fs-6 fw-bold">Read More About:</h3>
                                    <ol class="list-unstyled d-flex flex-wrap gap-2">
                                        <?php foreach ($tags as $tag): ?>
                                            <li><a href="<?= get_tag_link($tag->term_id); ?>" class="text-decoration-none text-danger text-uppercase"><?= $tag->name; ?></a></li>
                                        <?php endforeach; ?>
                                    </ol>
                                </nav>
                            </div>
                            <?php endif; ?>
                            <div class="border-bottom border-dark mb-4"></div>
                            <section class="more-posts">
                                <h2 class="kepler fw-bold text-uppercase mb-3">More from Guajantan</h2>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6"></div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-3">
                            <div class="position-sticky top-3-rem pb-3">
                                <!-- Sidebar content -->
                                halo
                            </div>
                        </div>
                    </div>
                </section>
            </article>
        <?php endwhile; ?>
    </div>

<?php
}

genesis();
