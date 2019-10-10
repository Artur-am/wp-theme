<?php get_header(); ?>

    <div class="wrapper row">

        <?php testIO_get_template_part('sections/section-card'); ?>


        <main class="col col-7 content">

            <?php testIO_get_template_part('sections/section-with-navigation', [
                'taxonomy' => 'category',
                'args'     => array(
                    'posts_per_page' => 5,
                    'post_type'      => 'post',
                    'orderby'        => 'id',
                    'order'          => 'DESC'
                )
            ] ); ?>

            <?php testIO_get_template_part('sections/section-with-navigation', [
                'taxonomy' => 'gallery',
                'args'     => array(
                    'posts_per_page' => 3,
                    'post_type'      => 'galler',
                    'orderby'        => 'id',
                    'order'          => 'DESC'
                )
                ]
            ); ?>

            <div class="posts-list">
                <?php testIO_get_template_part('posts/posts-category', [
                    'description' => null,
                    'args'        => array(
                            'posts_per_page' => 10,
                            'post_type'      => 'post',
                            'orderby'        => 'id',
                            'order'          => 'ASC'
                        )
                ]); ?>
            </div>

        </main>

        <aside class="col col-3 v-top">
            <?php get_sidebar(); ?>
        </aside>
    
    </div>

<?php get_footer(); ?>