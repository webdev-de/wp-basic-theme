<?php

/**
 * MWD THEME by Jan Behrens
 * Last Update: 02/23
 * Desc: This File is for displaying static pagesn like an about page 
 */

get_header();
?>

<div class="mwd_content">

    <?php if (my_header_display()) : ?>

        <header class="main_header">
            <div class="container">
                <div class="header_logo"><?php mwd_get_logo(); ?></div>
                <div class="menu-container"><?php mwd_menu("primary_menu"); ?></div>
            </div>
        </header>

    <?php else : ?>
        OKI DOKI KEIN HEADER
    <?php endif; ?>

    <?php mwd_menu_list(); ?>
    <div>
        <div class="container">
            <?= create_breadcrumb_navigation(); ?>
        </div>
    </div>


    <button class="btn">TEST</button>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- Hier wird der Inhalt des Beitrags ausgegeben -->
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_content(); ?>

        <?php endwhile; ?>
    <?php else : ?>

        <!-- Hier wird ausgegeben, wenn keine Beiträge gefunden wurden -->
        <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>

    <?php endif; ?>

</div>
<?php get_footer();
