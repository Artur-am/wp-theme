<?php get_header(); ?>

<?php
    if(have_posts()) {
        $args = '';
    }else{
        $args = array(
            'posts_per_page' => 5,
            'post_type' => 'galler'
        );
    }
?>

<div class="wrapper row">

    <main class="col col-8 content">

        <?php testIO_get_template_part('posts/posts-gallery', [
            'pagination'  => null,
            'args'        => $args
        ]); ?>

    </main>

    <aside class="col col-2 sidebar v-top">
        <?php get_sidebar(); ?>
    </aside>

</div>

<?php get_footer(); ?>