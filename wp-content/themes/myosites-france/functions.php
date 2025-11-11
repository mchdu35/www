<?php



function mf_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js", ['popper'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', [], false, true);

    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('popper');
}


function mf_theme_support()
{
    // Ajoute le support du titre de thème
    add_theme_support('title-tag');
}


function mf_filter_title($title)
{
    return 'Salut : ' . $title;
}

add_action('after_setup_theme', 'mf_theme_support');
add_action('wp_enqueue_scripts', 'mf_register_assets');
add_filter('wp_title', 'mf_filter_title');
