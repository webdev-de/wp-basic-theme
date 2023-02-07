<?php get_header(); ?>

<div class="mwd_content">
    <main>
        <?= mwd_content_type(); ?>
        <h1>OH NO EIN FEHLER IST AUFGETRETEN </h1>
        <h2>Die Seite : <?= $_SERVER['REQUEST_URI']; ?></h2>
    </main>
</div>

<?php get_footer();
