<?php get_header(); ?>

<div class="wrapper row">

    <main class="col col-7 content">

        <div class="posts-list">
            <?php testIO_get_template_part('posts/posts-category', [
                'description' => null,
                'pagination'  => null,
                'args'        => ''
            ]); ?>
        </div>

    </main>

    <aside class="col col-3 sidebar v-top">
        <?php get_sidebar(); ?>
    </aside>

</div>

<?php get_footer(); ?>