<?php

remove_action('genesis_loop', 'genesis_do_loop');

add_action('genesis_loop', 'content');

function content()
{
?>

    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <header class="py-4">
                    <h1 class="page__title playfair-font fw-bold text-center"><?php the_title(); ?></h1>
                </header>

                <div class="post__content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>

<?php
}

genesis();
