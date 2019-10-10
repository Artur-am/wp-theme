<?php $user = wp_get_current_user(); ?>

<?php wp_nav_menu( array(
    'theme_location'  => $user->exists() ? 'top_menu_for_authorized' : 'top_menu',
    'container'       => false,
    'menu_class'      => 'top-menu',
    'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
) ); ?>

<?php if($user->exists()) : ?>
    
    <span class="section-title v-middle">
        <?php echo $user->data->user_login; ?>
    </span>

<?php endif; ?>