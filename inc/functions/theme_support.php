<?php 
function mwd_theme_support()
{
    add_theme_support( 'title-tag');  // Nutzt das Titeltag

    $logo_defaults = array(
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	);
    add_theme_support( 'custom-logo', $logo_defaults ); // Erlaubt das Logo im Backend zu verwenden 
}
add_action('after_setup_theme', 'mwd_theme_support');
