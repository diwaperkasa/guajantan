<section id="most-read-article">
    <div class="container">
        <h2 class="mt-2 mb-4 fs-5">
            <span class="playfair-font text-uppercase ls-wider text-dark h4 border-top border-dark border-thickest">Most Read Stories</span>
        </h2>
        <?php
            global $post;
    
            $popularPostIds = wpp_get_ids([
                'post_type' => 'post',
                'limit' => 6,
                'range' => 'weekly'
            ]);
        ?>
        <div class="row justify-content-between">
            <?php foreach ($popularPostIds as $index => $postId): ?>
                <?php $post = get_post($postId); setup_postdata($post); ?>
                <div class="col-sm-6 <?= $index % 2 == 0 ? "col-md-4" : "col-md-3 pt-md-5" ?>">
                    <?php get_template_part('components/post', 'square') ?>
                </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>