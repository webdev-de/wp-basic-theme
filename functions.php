<?php

/**
 * MWD THEME by Jan Behrens
 * Last Update: 02/23
 * Desc: here the template related functions can be created and the wordpress functions can be overwritten if desired
 */

define('THEME_URL', get_template_directory_uri());
define('THEME_SCRIPT_URL', THEME_URL . '/assets/js/main.js');
define('THEME_STYLE_URL', THEME_URL . '/assets/css/main.css');
define('THEME_STYLE_VERSION', wp_get_theme()->get('Version'));

define('THEME_NAME', 'MWD BASIC');
define('THEME_PREFIX', 'mwd-base');

define('ROOT_DIR', __DIR__);

include_once ROOT_DIR . '/classes/Menu.php';

include_once ROOT_DIR . '/inc/functions/theme_support.php';
include_once ROOT_DIR . '/inc/functions/style.php';
include_once ROOT_DIR . '/inc/functions/script.php';
include_once ROOT_DIR . '/inc/functions/custom_logo.php';
include_once ROOT_DIR . '/inc/navigation.php';


function my_theme_customize_register($wp_customize)
{

    // Farbauswahl hinzufügen
    $wp_customize->add_setting('header_background_color', array(
        'default'           => '#ffffff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_background_color', array(
        'label'    => __('Header Hintergrund', 'my_theme'),
        'section'  => 'colors',
        'settings' => 'header_background_color',
    )));




    // Toggle-Option für das Anzeigen des Headers hinzufügen
    $wp_customize->add_setting( 'header_display', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'my_header_display_sanitize',
    ) );
  
    $wp_customize->add_control( 'header_display', array(
        'type'     => 'checkbox',
        'label'    => __( 'Header anzeigen', 'my_theme' ),
        'section'  => 'title_tagline',
        'settings' => 'header_display',
    ) );    
}
add_action('customize_register', 'my_theme_customize_register');


// Verwende die Farbe im Theme-Code
function my_header_background_color()
{
    return get_theme_mod('header_background_color', '#ffffff');
}

// Füge die Farbe in den CSS-Dateien hinzu
function my_header_background_color_css()
{
    $header_background_color = my_header_background_color();
?>
    <style type="text/css">
        header {
            background-color: <?php echo esc_html($header_background_color); ?> !important;
        }
    </style>
<?php
}
add_action('wp_head', 'my_header_background_color_css');
add_action( 'customize_register', 'my_theme_customize_register' );
  
  // Toggle-Option sanitizieren
  function my_header_display_sanitize( $input ) {
    return ( $input === true || $input === 'on' );
  }
  
  // Verwende die Toggle-Option im Theme-Code
  function my_header_display() {
    return get_theme_mod( 'header_display', true );
  }
  
  // Verstecke den Header im Frontend, wenn die Toggle-Option deaktiviert ist
  function my_header_display_css() {
      if ( ! my_header_display() ) {
          ?>
          <style type="text/css">
              .header {
                  display: none;
              }
          </style>
          <?php
      }
  }
  add_action( 'wp_head', 'my_header_display_css' );
  