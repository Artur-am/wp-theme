<?php
    if(empty($data['args']) && !is_array($data['args'])){
        $data['args'] = array(
            'posts_per_page' => 3,
            'orderby' => 'comment_count'
        );
    }

    $query = new WP_Query( $data['args'] );
?>

<div class="section-card row">

<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>

    <article class="card col">

        <?php if(has_post_thumbnail()): ?>
            <a class="thumb" href="<?php the_permalink(); ?>">
                <img src="<?php echo get_the_post_thumbnail_url(null,'free'); ?>" alt="<?php echo get_alt(get_post_thumbnail_id()); ?>">
            </a>
        <?php endif; ?>

        <div class="info">
            <h3 class="title">
                <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
            <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(get_option('date_format_custom')); ?></time>
        </div>

    </article>


<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

</div>

<div class="clear">&nbsp;</div>