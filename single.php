<?php get_header(); ?>

    <div class="wrapper row">

        <main class="col col-7 content">
        
            <?php if(have_posts()): while(have_posts()): the_post(); ?>

                <article class="single-post">

                    <h2 class="section-title">
                        <?php the_title(); ?>
                    </h2>

                    <ul class="info">
                        <li><?php the_category(); ?></li>
                        <li><?php the_author(); ?></li>
                        <li><?php the_date(); ?></li>
                        <li>
                            <a href="#commentform">
                                <?php comments_number(0); ?>
                            </a>
                        </li>
                    </ul>

                    <?php if(has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(null,'free'); ?>" alt="<?php echo get_alt(get_post_thumbnail_id()); ?>">
                    <?php endif; ?>

                    <div class="text">
                        <?php the_content(); ?>
                    </div>

                </article>

                <?php endwhile; ?>

                <?php else: ?>
                <article>
                    <h2 class="section-title center">
                        <?php echo __( '_No Records Found', DOMAIN_LANG ); ?>
                    </h2>
                </article>

            <?php endif; ?>

            <div class="testIO-form">
                <?php while (have_posts()) : the_post(); ?>
                    <?php comments_template(); ?>
                <?php endwhile; ?>
            </div>

        </main>

        <aside class="col col-3 sidebar v-top">
            <?php get_sidebar(); ?>
        </aside>

    </div>

<?php get_footer(); ?>