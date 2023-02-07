<?php

// JS WIRD DYNAMISCH EINGEBUNDEN ==>
function mwd_register_scripts()
{
    wp_enqueue_script(THEME_PREFIX, THEME_SCRIPT_URL, array(), false, true);
}
add_action('wp_enqueue_scripts', 'mwd_register_scripts');
 // <== JS WIRD DYNAMISCH EINGEBUNDEN