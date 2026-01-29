<?php
require_once('inc/class-walker-nav-menu-mf.php');


function mf_register_assets()
{
    // Styles
    wp_register_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css');
    wp_register_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css');
    wp_register_style('myosites-france', get_template_directory_uri() . '/css/myosites-france.css', array(), '1.3.0');

    // Scripts
    wp_register_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js', array(), null, true);
    wp_register_script('mf-menu-hover', get_template_directory_uri() . '/js/menu-hover.js', array(), '1.1.0', true);

    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('bootstrap-icons');
    wp_enqueue_style('myosites-france');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('mf-menu-hover');
}


function mf_theme_support()
{
    // Ajoute le support du titre de thème
    add_theme_support('title-tag');
    // Ajoute le support des images sur les post
    add_theme_support('post-thumbnails');
    // Ajoute le support du logo
    add_theme_support('custom-logo');
    // Ajoute le support du logo
    add_theme_support('menu');

    // Déclare un emplacement de menu dans le header
    register_nav_menu('headermenu', 'Menu principal');
    // Déclare un emplacement de menu latéral
    register_nav_menu('lateralmenu', 'Menu latéral');
}


// Note: Les classes Bootstrap sont maintenant gérées par Walker_Nav_Menu_MF
// Ne pas ajouter de filtres nav_menu_css_class ou nav_menu_link_attributes
// qui pourraient interférer avec le Walker

add_action('after_setup_theme', 'mf_theme_support');
add_action('wp_enqueue_scripts', 'mf_register_assets');
