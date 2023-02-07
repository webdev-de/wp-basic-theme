<?php

function mwd_get_logo($with_homelink = true)
{

    $custom_logo = '<h1>' . get_bloginfo('name') . '</h1>';

    if (has_custom_logo() && function_exists('the_custom_logo')) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, null);
        $custom_logo = '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
    }

    if ($with_homelink) {
        $custom_logo =  "<a class='main_logo' href='" . esc_url(home_url('/')) . "'>" . $custom_logo . "</a>";
    }
    
    echo $custom_logo;
}