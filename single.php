<?php

/**
 * MWD THEME by Jan Behrens
 * Last Update: 02/23
 * Desc: This is the page for single blog posts
 */
?>
<?php get_header(); ?>

<div class="mwd_content">
    <main>
        <?= mwd_content_type(); ?>
    </main>
</div>

<?php get_footer();