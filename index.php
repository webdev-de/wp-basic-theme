<?php

/**
 * MWD THEME by Jan Behrens
 * Last Update: 02/23
 * Desc: This file is required by Wordpress and serves as a fallback. 
 * To understand the fallback of the pages, 
 * it is worth taking a look at https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png.  
 */

get_header();
?>

<header class="main_header">
    <?php mwd_get_logo(); ?>
</header>

<?php
mwd_menu("primary_menu");
mwd_menu_list();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- Hier wird der Inhalt des Beitrags ausgegeben -->
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_content(); ?>

    <?php endwhile; ?>
<?php else : ?>

    <!-- Hier wird ausgegeben, wenn keine Beiträge gefunden wurden -->
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer();
