<?

// Regestriert die Menüs fürs nutzen auf dem Template 
if (!function_exists('mwd_menus')) {
    function mwd_menus()
    {
        $text_domain = 'mwd';
        $locations = array(
            'primary_menu' => __('Desktop Main Menu', $text_domain),
            'footer_menu' => __('Desktop Footer Menu', $text_domain),
        );

        register_nav_menus($locations);
    }
    add_action('after_setup_theme', 'mwd_menus');
}

if (!function_exists('mwd_menu')) {
    // function to generate and display a menu based on the provided menu name
    function mwd_menu(string $menu_name): void
    {
        // create a new menu object with the provided menu name, starting at the top-level item (0), with a maximum depth of 2 levels
        $menu = new Menu($menu_name, 0, 10);

        // get the menu items
        $menuItems = $menu->getItems();

        // render the menu items
        $renderMenu = $menu->render($menuItems);

        // check if the menu has any items, and if so, display the rendered menu
        if (count($menu->menuItems) > 0) {
            echo $renderMenu;
        }
    }
}


function create_breadcrumb_navigation()
{
    $navigation = "";
    $home = 'Home';
    $before = '<span class="current">';
    $after = '</span>';
    $separator = "/";

    if (!is_home()) {
        $navigation .= '<a href="' . get_home_url() . '">' . $home . '</a>';

        if (is_category() || is_single()) {
            $categories = get_the_category();
            $navigation .= $separator;
            $navigation .= '<a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a>';

            if (is_single()) {
                $navigation .= $separator . get_the_title();
            }
        } elseif (is_page()) {
            $navigation .= $separator . get_the_title();
        } elseif (is_tag()) {
            $navigation .= $separator . single_tag_title();
        } elseif (is_day()) {
            $navigation .= $separator . get_the_time('F jS, Y');
        } elseif (is_month()) {
            $navigation .= $separator . get_the_time('F, Y');
        } elseif (is_year()) {
            $navigation .= $separator . get_the_time('Y');
        } elseif (is_author()) {
            $navigation .= $separator . get_the_author();
        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
            $navigation .= $separator  . "Blog Archive";
        }
    }
    return $navigation;
}


function mwd_content_type()
{
    global $wp_query;
    $loop = 'notfound';

    if ($wp_query->is_page) {
        $loop = is_front_page() ? 'front' : 'page';
    } elseif ($wp_query->is_home) {
        $loop = 'home';
    } elseif ($wp_query->is_single) {
        $loop = ($wp_query->is_attachment) ? 'attachment' : 'single';
    } elseif ($wp_query->is_category) {
        $loop = 'category';
    } elseif ($wp_query->is_tag) {
        $loop = 'tag';
    } elseif ($wp_query->is_tax) {
        $loop = 'tax';
    } elseif ($wp_query->is_archive) {
        if ($wp_query->is_day) {
            $loop = 'day';
        } elseif ($wp_query->is_month) {
            $loop = 'month';
        } elseif ($wp_query->is_year) {
            $loop = 'year';
        } elseif ($wp_query->is_author) {
            $loop = 'author';
        } else {
            $loop = 'archive';
        }
    } elseif ($wp_query->is_search) {
        $loop = 'search';
    } elseif ($wp_query->is_404) {
        $loop = 'notfound';
    }

    return $loop;
}

// Gibt eine Liste der regestrierten Menüs aus
if (!function_exists('mwd_menu_list')) {
    function mwd_menu_list()
    {
        $registered_menus = get_registered_nav_menus();
        $result = '';
        foreach ($registered_menus as $location => $description) {
            $result .= "Location: $location, Description: $description <br>";
        }
        echo $result;
    }
}
