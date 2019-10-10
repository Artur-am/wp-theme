<?php

    $query = new GetPosts( $data['args'] );

?>

<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>

    <div class="post-gallery">
        
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="thumb">
                <img src="<?php echo get_the_post_thumbnail_url(null,'free'); ?>" alt="<?php echo get_alt(get_post_thumbnail_id()); ?>">

                <div class="animation">
                    <span class="float-left">
                        <?php comments_number( 0, 1, '%'); ?>
                        <i class="dashicons dashicons-format-status"></i>
                    </span>

                    <span class="section-title">click</span>

                    <span class="float-right">
                        <?php echo get_post_meta ( get_the_ID(),'views', true); ?>
                        <i class="dashicons dashicons-visibility"></i>
                    </span>
                    <div class="wave"></div>
                </div>
            </div>

            <div class="info"></div>
        </a>
    </div>

<?php endwhile; ?>

<?php if( array_key_exists('pagination', $data)): ?>

    <?php echo $query->pagination(); ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php endif; ?>
