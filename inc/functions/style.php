<?php
// CSS WIRD DYNAMISCH EINGEBUNDEN ==>
function mwd_register_styles()
{
    // Im Parameter 3 (DEPS) wird die Abhänigkeit zu anderen Stylesheets angegeben das heisst wenn dieser Style einen anderen benötigt zwecks vererbungg von styles oder kann das stylesheet von dem man Abhänig ist dort angegeben werden 
    wp_enqueue_style(THEME_PREFIX, THEME_STYLE_URL, false, THEME_STYLE_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'mwd_register_styles');
// <== CSS WIRD DYNAMISCH EINGEBUNDEN