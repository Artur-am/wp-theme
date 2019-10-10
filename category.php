<?php get_header(); ?>

<?php
    if(have_posts()) {
        $args = '';
    }else{
        $args = array(
            'post_type' => 'post',
            'orderby' => 'id',
            'order'   => 'DESC'
        );
    }
?>

<div class="wrapper row">

    <main class="col col-7 content">

        <div class="posts-list">
            <?php testIO_get_template_part('posts/posts-category', [
                'description' => null,
                'pagination'  => null,
                'args'        => $args
            ]); ?>
        </div>

    </main>

    <aside class="col col-3 sidebar v-top">
        <?php get_sidebar(); ?>
    </aside>

</div>

<?php get_footer(); ?>