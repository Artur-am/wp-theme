<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="wrapper">

	<div class="header_top row v-b-middle">
		<div class="col col-4 v-middle">
			<a href="<?php echo home_url('/'); ?>" class="link-home">
				<?php echo get_bloginfo( 'name' ); ?>
			</a>
		</div>
		<div class="col col-6 align-right v-middle">

			<?php get_template_part( 'template-parts/header-top', 'menu' ); ?>
		
		</div>
	</div>

	<div class="header_bottom row  v-b-middle">

		<div class="col col-4 header_logo v-middle">
			<?php echo testIO_custom_logo(); ?>
		</div>

		<div class="col col-6 align-right v-middle">
			<?php wp_nav_menu( array(
				'theme_location'  => 'nav_menu',
				'container'       => false,
				'menu_class'      => 'nav',
				'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
			) ); ?>
		</div>

	</div>

	<?php
		if( function_exists( 'the_breadcrumb' ) ){
			the_breadcrumb();
		}
	?>

</header>
