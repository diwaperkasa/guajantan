<?php
$popular_ids = wpp_get_ids([
    'limit' => 6,
    'range' => 'weekly',
    'post_type' => 'post',
    'no_found_rows'  => true,
]);

$query = new WP_Query([
    'post__in' => $popular_ids,
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'post__in',
]);
?>

<footer>
    <section class="mb-4">
        <div class="container">
            <h2 class="mt-2 mb-4 fs-5">
                <span class="playfair-font text-uppercase ls-wider text-dark h4 border-top border-dark border-thickest">Top Stories</span>
            </h2>
            <div class="row justify-content-between">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="col-sm-6 <?= $query->current_post % 2 == 0 ? "col-md-4" : "col-md-3" ?>">
                            <?php get_template_part('components/post', 'square') ?>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    </div>
    <section class="bg-black py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <img src="https://www.hollywoodreporter.com/wp-content/uploads/2026/04/9D_cover_RichardGadd_lo_res_db09db.jpg" alt="Guajantan Logo" class="img-fluid w-100 mb-3">
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <?php $menus = get_wp_menu_tree('footer'); ?>
                        <div class="col-md-3 col-sm-6">
                            <h2 class="playfair-font fw-bold text-white h4">Subscriber Support</h2>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h2 class="playfair-font fw-bold text-white h4">Guajantan</h2>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h2 class="playfair-font fw-bold text-white h4">Legal</h2>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h2 class="playfair-font fw-bold text-white h4">Follow Us</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="playfair-font fw-bold text-center text-white h4">Newsletter Sign Up</h2>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="playfair-font fw-bold text-center text-white h4">Have a Tip?</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
</footer>