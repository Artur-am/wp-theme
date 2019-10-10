<?php $query = new WP_Query( testIO_QueryArgs( 'posts-list' ) ); ?>

<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
            
    <article class="post">
                        
        <?php if(has_post_thumbnail()): ?>
            <a class="thumb v-middle" href="<?php the_permalink(); ?>">
                <img src="<?php echo get_the_post_thumbnail_url(null,'free'); ?>" alt="<?php echo get_alt(get_post_thumbnail_id()); ?>">
            </a>
        <?php endif; ?>

        <div class="info v-middle">
            <h3 class="title">
                <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
            <div class="text">
                <?php the_excerpt(); ?>
            </div>
            <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(get_option('date_format_custom')); ?></time>
        </div>
                
    </article>

<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>