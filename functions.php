<?php

require_once( get_template_directory() .  '/library/translation/translation.php');

require_once('inc/cpt.php');
require_once('inc/GetPosts.php');
require_once('inc/breadCrumbs.php');

function testIO_wpHead(){

    if(is_page('auth')){
        if(is_user_logged_in()){
            wp_redirect( home_url() ); 
            exit;
        }
    }

}
add_action( 'wp', 'testIO_wpHead' );

function testIO_setup(){
/*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
*/
    add_theme_support( 'title-tag' );

/**
    * Add support for core custom logo.
    *
    * @link https://codex.wordpress.org/Theme_Logo
*/
    add_theme_support('custom-logo');
        
/*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
*/
    add_theme_support( 'post-thumbnails' );
    // set_post_thumbnail_size( 1568, 9999 );

//  This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'category'      => 'Category',
            'nav_menu'   => 'Navigation menu',
            'top_menu' => 'Top menu',
            'top_menu_for_authorized' => 'Top menu for authorized'
        ) );
}
add_action( 'after_setup_theme', 'testIO_setup' );


/**
 * Enqueue scripts and styles.
 */
function testIO_scripts() {
    wp_enqueue_style('testIO-style', get_stylesheet_uri());
    wp_enqueue_style('testIO-css', get_template_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script('testIO-script', get_template_directory_uri() . '/assets/js/main.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'testIO_scripts' );

/**
 * Get logo.
 */
function testIO_custom_logo(){
    $output = '';
    if( has_custom_logo() ){
        $output = get_custom_logo();
    }else{
        $output = '<a href="' . esc_url( home_url('/') ) . '">' . get_bloginfo( 'name' ) . '</a>';
    }

    return $output;
}

function testIO_init(){
    
    if(class_exists('CPT')){
        new CPT( __( '_Gallerys', DOMAIN_LANG ), __( '_The gallery', DOMAIN_LANG ), __( '_gallery', DOMAIN_LANG ), 'galler', 'dashicons-images-alt2', false, true );
    }

    if(class_exists('CPT_Taxonomy')){
        new CPT_Taxonomy( __( '_Headings', DOMAIN_LANG ), __( '_Rubric Gallery', DOMAIN_LANG ),  __( '_Headings', DOMAIN_LANG ), 'galler', 'gallery', true);
    }
}
add_action( 'init', 'testIO_init' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function testIO_widgets_init(){

	register_sidebar(
		array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar',
			'description'   => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
    );

}
add_action( 'widgets_init', 'testIO_widgets_init' );

/*
* GET Alt
*/
function get_alt($id){
	$c_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
	$c_tit = get_the_title($id);
	return $c_alt?$c_alt:$c_tit;
}

function testIO_get_template_part($template, $data = array()){
    $url_file = 'template-parts/' . $template . '.php';

    require locate_template( $url_file );
}

/*
* Хлебные крошки
*/
function the_breadcrumb(){
    $breadcrumb = new breadCrumbs();
    if($breadcrumb->countBreadcrumb > 1){
        echo '<div class="bread-crumbs">' . $breadcrumb->breadcrumbs . '</div>';
    }else{
        return '';
    }
}


/*
* Подсчет количества посещений страниц
* url: https://wp-kama.ru/id_55/schitaem-kolichestvo-posescheniy-stranits-na-wordpress.html
*/
add_action('wp_head', 'kama_postviews');
function kama_postviews() {

/* ------------ Настройки -------------- */
$meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.
$who_count      = 0;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированных пользователей.
$exclude_bots   = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.

global $user_ID, $post;
	if(is_singular()) {
        $id = (int)$post->ID;
		static $post_views = false;
		if($post_views) return true; // чтобы 1 раз за поток
        $post_views = (int)get_post_meta($id,$meta_key, true);
		$should_count = false;
		switch( (int)$who_count ) {
			case 0: $should_count = true;
				break;
			case 1:
				if( (int)$user_ID == 0 )
					$should_count = true;
				break;
			case 2:
				if( (int)$user_ID > 0 )
					$should_count = true;
				break;
		}
		if( (int)$exclude_bots==1 && $should_count ){
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
			$bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
			if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
				$should_count = false;
        }
        
        if($should_count)
            if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
	}
	return true;
}