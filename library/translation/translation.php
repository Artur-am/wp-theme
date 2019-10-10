<?php
// Adding Translation Option
define( 'DOMAIN_LANG', '_testIO' );

load_theme_textdomain( DOMAIN_LANG , get_template_directory() .'/library/translation' );
$locale = get_locale();
$locale_file = get_template_directory() ."/library/translation/$locale.php";

if ( is_readable($locale_file) ) {
    require_once($locale_file); 
}
?>