<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="view-port" content="width=device-width, initial-scale=1.0">
    <?php
    // inclusion des éléments bootstrap etc...
    wp_head();
    ?>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">

            <?php

            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'thumbnail');


            if (has_custom_logo()) {
            ?>
                <a href="/"><img src="<?= esc_url($logo[0]) ?>" alt="<?= get_bloginfo('name') ?>" style="width:60px; height:auto"></a>
            <?php } ?>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Barre de navigation avec dropdowns Bootstrap 5 -->
                <?php
                wp_nav_menu([
                    'theme_location' => 'headermenu',
                    'container' => false,
                    'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'walker' => new Walker_Nav_Menu_MF()
                ]);
                ?>


                <?php
                if (!wp_nav_menu(['theme_location' => 'headermenu', 'echo' => false])) {
                ?>
                    <div class="navbar-nav me-auto mb-2 mb-lg-0"></div>
                <?php } ?>
                <!-- Formulaire de recherche -->
                <?php get_search_form(); ?>
            </div>
        </div>
    </nav>


    <div class="container-fluid">