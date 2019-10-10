<?php
    $taxonomy = empty($data['taxonomy']) ? 'category' : $data['taxonomy'];

    $categories = get_categories(array(
        'taxonomy'     => $taxonomy,
        'parent'       => '0',
        'orderby'      => 'count',
        'order'        => 'DESC',
        'hide_empty'   => 1,
        'number'       => 7
    ));
?>

<section class="section-wrap">

    <header class="row">
        <div class="col col-4">
            <h2 class="section-title"><?php echo __( '_Section title', DOMAIN_LANG ); ?> <?php echo $taxonomy; ?></h2>
        </div>

        <div class="col col-6 section-wrap-nav align-right">
            <ul>

                <?php foreach($categories as $category): ?>

                    <li data-link="<?php echo $category->term_id; ?>">
                        <?php echo $category->name; ?>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div>
    </header>

    <div class="section-wrap-content <?php echo $taxonomy; ?>">
    
        <?php testIO_get_template_part( 'posts/posts-' . $taxonomy, array(
            'args' => $data['args']
        ) ); ?>

    </div>

</section>

<div class="clear">&nbsp;</div>